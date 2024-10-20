<?php

namespace App\Http\Controllers;
use App\Models\Survey; 
use App\Models\Question; 
use App\Models\Credits; // Make sure to import the Credits model
use App\Models\Option; 
use App\Models\User; 

use App\Models\SupportTicket; 
use App\Models\Withdrawal; // Ensure to import the Withdrawal model

use Illuminate\Support\Facades\Schema;
use App\Models\Response; // Import the Survey model
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\UserProfile; // Ensure this line exists
use App\Models\SurveyTarget; // Ensure this line exists

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NestedQuestion;
use App\Models\Balance;
use Carbon\Carbon;

class SurveyController extends Controller
{


    public function updateSurveyStatus($surveyId)
    {
        // Find the survey
        $survey = Survey::findOrFail($surveyId);
    
        // Get the total responses for the survey
        $totalResponses = $survey->responses()->count(); // Assuming a relationship with responses
    
        // Check the respondent limit
        if ($totalResponses >= $survey->respondent_limit) {
            // Set status to completed
            $survey->status = 'completed';
        } else {
            // Set status to active
            $survey->status = 'active';
        }
    
        // Save the survey
        $survey->save();
    }
    


   

    public function tickethistory()
    {
        // Fetch tickets associated with the authenticated user
        $tickets = SupportTicket::where('user_id', Auth::id())->get();

        return view('business.tickethistory', compact('tickets'));
    }
    public function usertickethistory()
    {
        // Fetch tickets associated with the authenticated user
        $tickets = SupportTicket::where('user_id', Auth::id())->get();

        return view('user.tickethistory', compact('tickets'));
    }
    public function createticket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        $userId = auth()->id();

        SupportTicket::create([
            'user_id' => $userId,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
        ]);

        return redirect()->route('business.ticket')->with('success', 'Ticket created successfully');
    }

    public function usercreateticket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        $userId = auth()->id();

        SupportTicket::create([
            'user_id' => $userId,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
        ]);

        return redirect()->route('user.ticket')->with('success', 'Ticket created successfully');
    }

    public function showAddProfilePage()
    {
        // Return the view for adding a profile
        return view('user.addProfile'); // Ensure this is the correct path to your Blade view
    }
    
    public function saveProfile(Request $request)
{     
    //   dd($request->all());
    // Validate the incoming request data
    $validatedData = $request->validate([
        'age' => 'required|integer',
        'city' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'region' => 'required|string|max:255',
        'gender' => 'required|string|in:male,female,other',
        'education_level' => 'required|string|max:255',
        'telecom1' => 'required|string|max:255',
        'telecom2' => 'nullable|string|max:255',
        'mobile_money1' => 'required|string|max:255',
        'mobile_money2' => 'nullable|string|max:255',
        'nationality1' => 'required|string|max:255',
        'bank1' => 'required|string|max:255',
        'bank2' => 'nullable|string|max:255',
        'employment_status' => 'required|in:employed,unemployed',
        'salary_range' => 'required|in:A,B,C',
    ]);
    // dd($validatedData);

    // Create or update the user profile
    $userId = auth()->id();

    UserProfile::updateOrCreate(
        ['userid' => $userId],  // Match the user ID
        [
            'age' => $validatedData['age'],
            'city' => $validatedData['city'],
            'country' => $validatedData['country'],
            'region' => $validatedData['region'],
            'gender' => $validatedData['gender'],
            'education_level' => $validatedData['education_level'],
            'telecom1' => $validatedData['telecom1'],
            'telecom2' => $validatedData['telecom2'],
            'mobile_money1' => $validatedData['mobile_money1'],
            'mobile_money2' => $validatedData['mobile_money2'],
            'nationality1' => $validatedData['nationality1'],
            'bank1' => $validatedData['bank1'],
            'bank2' => $validatedData['bank2'],
            'employment_status' => $validatedData['employment_status'],
            'salary_range' => $validatedData['salary_range'],
        ]
    );  


    // Redirect the user to the dashboard after saving the profile
    return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
}


public function show($id)
{
    // Retrieve the survey by ID or fail if not found
    $survey = Survey::findOrFail($id); 
    
    // Retrieve questions related to the survey
    $questions = $survey->questions()->with('options')->get(); // Assuming a relationship exists

    // Pass the survey data and questions to the view
    return view('user.survey_detail', [
        'survey' => $survey,
        'questions' => $questions, // Pass questions with options to the view
    ]);
}




public function submitAnswers(Request $request)
{
    $userId = $request->user()->id; // Get the user ID

    $surveyId = $request->input('survey_id'); // Get the survey ID
    // CREDITS
    $survey = Survey::findOrFail($surveyId);

    $credits = Credits::where('user_id', $userId)->first(); // Fetch the user's credits record

        if ($credits) {
            // dd($survey->credits);
            // Increase the amount (for example, adding 10 credits)
            $credits->amount += ($survey->credits); // Adjust this value as needed
            $credits->save(); // Save the updated credits
        } else {
            // If no credits record exists for the user, you can create one
            Credits::create([
                'user_id' => $userId,
                'amount' => ($survey->credits), // Initial amount if it didn't exist
            ]);
        }

// dd($request->answers);
    
foreach ($request->answers as $responseData) {
    $response = new Response();

    // Assuming $surveyId and $userId are already available
    $response->survey_id = $surveyId;
    $response->user_id = $userId;

    // Assign question_id and option_id from $responseData
    $response->question_id = $responseData['question_id'];  // Store question ID
    $response->option_id = $responseData['option_id'] ; // Store option ID, if available

    // Save the response to the database
    $response->save();
}


    // Save the formatted answers to the survey_responses table

    // Flash a success message and redirect
    Session::flash('alert', 'Your action was successful! Please wait 1 hr while your credits are being verified.');
    return redirect()->route('dashboard'); // Assuming 'dashboard' is the name of the route for '/user'
}


public function usersettings()
{
    // Retrieve the current user's profile

    $userId = auth()->id(); // Get the logged-in user's ID

    $userprofile = UserProfile::where('userid', $userId)->first();
// dd($userProfile);
return view('user.usersettings', compact('userprofile'));

}










public function userviewsurvey() {
    $userId = auth()->id(); // Get the logged-in user's ID
    $credits = Credits::where('user_id', $userId)->first(); // Fetch the user's credits record
    $creditsamount = $credits ? $credits->amount : 0; // Set to 0 if no credits record exists

    $totalWithdrawals = Withdrawal::where('user_id', $userId)->sum('amount');
    $completedCount = DB::table('responses')->where('user_id', $userId)->count();
    $totalTransactions = Withdrawal::where('user_id', $userId)->count();

    // Get the IDs of surveys the user has completed
    $completedSurveyIds = Response::where('user_id', $userId)->pluck('survey_id')->toArray();
    $surveyCount = count($completedSurveyIds); // This will count the number of survey IDs
    // Retrieve the user's profile
    $userProfile = UserProfile::where('userid', $userId)->first();

    // Check if the user profile exists
    if (!$userProfile) {
        // Redirect the user to the Add Profile page if no profile exists
        return redirect()->route('addProfilePage')->with('message', 'Please complete your profile before proceeding.');
    }

    // Fetch all surveys with their targets
    $surveys = Survey::with('target')->whereNotIn('id', $completedSurveyIds);
    
    $matchingSurveys = collect(); // Initialize a Laravel collection to store matching surveys
    foreach ($surveys as $survey) {
        if ($survey->target) {
            // Convert the target to an array
            $targetArray = $survey->target->toArray(); 
    
            // Remove unwanted fields
            unset($targetArray['id'], $targetArray['survey_id'], $targetArray['created_at'], $targetArray['updated_at']);
    
            // Filter out null values
            $nonNullFields = array_filter($targetArray, function ($value) {
                return !is_null($value); // Keep only fields with values
            });

            $match = true; // Assume match is true unless proven otherwise
    
            foreach ($nonNullFields as $key => $value) {
                // Check if the key exists in userProfile
                if (isset($userProfile->$key)) {
                    // Compare the values
                    if ($value !== $userProfile->$key) {
                        // If any field does not match, set match to false
                        $match = false;
                        break; // Exit the inner loop since we found a mismatch
                    }
                }
            }
    
            // If all fields match, add the survey and its non-null fields to the new array
            if ($match) {
                $matchingSurveys->push($survey); // Use the collection's push method
            }
        }
    }
    return view('user.dashboard', [
        'surveys' => $matchingSurveys, // Pass the collection to the view
        'completedCount' => $completedCount,
        'surveyCount'=>$surveyCount,
        'totalTransactions'=>$totalTransactions,
        'creditsamount' => $creditsamount,
        'totalWithdrawals'=>$totalWithdrawals,
    ]);
}
public function showallsurveys()
{
    $userId = auth()->id(); // Get the current user's ID

    // Retrieve the user's profile
    $userProfile = DB::table('user_profile')->where('userid', $userId)->first();

    if (!$userProfile) {
        // If the user profile does not exist, return an empty result or handle accordingly
        return view('user.showallsurveys', [
            'surveys' => collect(), // Empty collection if no profile is found
            'completedCount' => 0,
        ]);
    }

    // Get IDs of surveys the user has already completed
    $completedSurveyIds = Response::where('user_id', $userId)
        ->pluck('survey_id')
        ->toArray();

    // Fetch surveys that the user has not completed
    $surveys = Survey::whereNotIn('id', $completedSurveyIds)
        ->with('target') // Assuming Survey has a 'target' relationship
        ->get();

    // Filter surveys based on the surveytarget fields
    $filteredSurveys = $surveys->filter(function ($survey) use ($userProfile) {
        // If the survey has no target, include it (user can take the survey)
        if (!$survey->target) {
            return true; // Include surveys without a target
        }

        $target = $survey->target;

        // Apply dynamic filtering based on non-null fields in the surveytarget table
        if ($target->age && $userProfile->age != $target->age) {
            return false;
        }
        if ($target->gender && $userProfile->gender != $target->gender) {
            return false;
        }
        if ($target->education_level && $userProfile->education_level != $target->education_level) {
            return false;
        }
        if ($target->city && $userProfile->city != $target->city) {
            return false;
        }
        if ($target->country && $userProfile->country != $target->country) {
            return false;
        }
        if ($target->region && $userProfile->region != $target->region) {
            return false;
        }
        if ($target->telecom1 && $userProfile->telecom1 != $target->telecom1) {
            return false;
        }
        if ($target->telecom2 && $userProfile->telecom2 != $target->telecom2) {
            return false;
        }
        if ($target->mobile_money1 && $userProfile->mobile_money1 != $target->mobile_money1) {
            return false;
        }
        if ($target->mobile_money2 && $userProfile->mobile_money2 != $target->mobile_money2) {
            return false;
        }
        if ($target->nationality1 && $userProfile->nationality1 != $target->nationality1) {
            return false;
        }
        if ($target->bank1 && $userProfile->bank1 != $target->bank1) {
            return false;
        }
        if ($target->bank2 && $userProfile->bank2 != $target->bank2) {
            return false;
        }
        if ($target->employment_status && $userProfile->employment_status != $target->employment_status) {
            return false;
        }
        if ($target->salary_range && $userProfile->salary_range != $target->salary_range) {
            return false;
        }

        // If all the checks pass, include the survey
        return true;
    });

    return view('user.showallsurveys', [
        'surveys' => $filteredSurveys,
        'completedCount' => count($completedSurveyIds),
    ]);
}



//--------------------------------------------8-8-8-8-8--8-8-8----------------BUSINESS











public function showsingle($surveyId)
{
      // Fetch all responses for the survey
      $responses = Response::where('survey_id', $surveyId)->get();

      // Group responses by question_id
      $groupedResponses = $responses->groupBy('question_id');
  
      // Fetch all options for the survey questions
      $options = Option::whereIn('question_id', $groupedResponses->keys())->get();
  
      // Organize options by question_id
      $groupedOptions = $options->groupBy('question_id');
  
      // Fetch all questions for the survey
      $questions = Question::where('survey_id', $surveyId)->get()->keyBy('id');
  
      $results = [];
  
      foreach ($groupedResponses as $questionId => $responses) {
          // Initialize the result for this question
          $results[$questionId] = [
              'question_text' => $questions[$questionId]->question_text ?? 'Unknown Question', // Fetch question text
              'options' => [],
              'response_count' => $responses->count(),
          ];
  
          // Get the options for this question
          if (isset($groupedOptions[$questionId])) {
              foreach ($groupedOptions[$questionId] as $option) {
                  // Count how many responses correspond to this option
                  $optionCount = $responses->where('option_id', $option->id)->count();
                  
                  // Store the option and the response count
                  $results[$questionId]['options'][] = [
                      'id' => $option->id,
                      'option_text' => $option->option_text,
                      'response_count' => $optionCount,
                  ];
              }
          }
      }
  

    // Pass the results to the view
    return view('business.survey-responses', compact('results'));
    }











    public function create()
    {
        $balance = Balance::where('user_id', auth()->id())->first();
         return view('business.create-survey',compact('balance'));
    }
    
  
    public function store(Request $request)
    {
        $userId = Auth::id();
        $credits = $request->credits;
        $respondent_limit = $request->respondent_limit;
        $balance = Balance::where('user_id', auth()->id())->first();
        $campaignCost = $credits * $respondent_limit;
        $userBalance = $balance->balance;
         // Check if user has enough balance
        if ($userBalance < $campaignCost) {
            return redirect()->route('business.deposit')->withErrors(['insufficient_balance' => 'Please deposit funds to create this survey.']);
        }
    
        // Deduct the campaign cost from the user balance
        $balance->balance -= $campaignCost;
        $balance->save();
    
        // Validate request data
        $request->validate([
            'title' => 'required|string|max:255',
            'age' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'questions' => 'required|array',
            'questions.*.question_text' => 'required|string|max:255',
            'questions.*.question_type' => 'required|string',
            'questions.*.options' => 'required|array',
            'questions.*.options.*' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);
    
        // Start a transaction
        DB::transaction(function () use ($request, $userId) {
            // Create a new survey entry in the database
            $surveyData = [
                'user_id' => $userId,
                'title' => $request->input('title'),
                'age' => $request->input('age'),
                'location' => $request->input('location'),
                'gender' => $request->input('gender'),
                'credits' => $request->credits,
                'respondent_limit' => $request->respondent_limit,
                'created_at' => now(),
            ];
    
            // Handle the image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('survey_images', 'public');
                $surveyData['image'] = $imagePath; // Add image path to survey data
            }
    
            // Save the survey
            $survey = Survey::create($surveyData);
            // dd($request);
            // Save survey targets and questions as before
            SurveyTarget::create([
                'survey_id' => $survey->id,
                'age' => $request->age,
                'gender' => $request->gender,
                'education_level' => $request->education_level,
                'city' => $request->city,
                'country' => $request->country,
                'region' => $request->region,
                'telecom1' => $request->telecom1,
                'telecom2' => $request->telecom2,
                'mobile_money1' => $request->mobile_money1,
                'mobile_money2' => $request->mobile_money2,
                'nationality1' => $request->nationality1,
                'bank1' => $request->bank1,
                'bank2' => $request->bank2,
                'employment_status' => $request->employment_status,
                'salary_range' => $request->salary_range,
            ]);
    
            // Process each question
            foreach ($request->input('questions') as $questionData) {
                $question = Question::create([
                    'question_text' => $questionData['question_text'],
                    'question_type' => $questionData['question_type'],
                    'survey_id' => $survey->id,
                ]);
    
                foreach ($questionData['options'] as $optionText) {
                    Option::create([
                        'option_text' => $optionText,
                        'question_id' => $question->id,
                    ]);
                }
    
                // Handle nested questions if any
                if (isset($questionData['nested_questions'])) {
                    foreach ($questionData['nested_questions'] as $nestedQuestionData) {
                        $nestedQuestion = Question::create([
                            'question_text' => $nestedQuestionData['question_text'],
                            'question_type' => $nestedQuestionData['question_type'],
                            'survey_id' => $survey->id,
                            'parent_question_id' => $question->id,
                        ]);
    
                        foreach ($nestedQuestionData['options'] as $optionText) {
                            Option::create([
                                'option_text' => $optionText,
                                'question_id' => $nestedQuestion->id,
                            ]);
                        }
                    }
                }
            }
        });
    
        // Redirect with success message
        return redirect()->route('business')->with('success', 'Survey created successfully.');
    }
    
    

    public function storeSurveyWithQuestions(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure user exists
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'age' => 'nullable|string|max:50', // Validate age
            'location' => 'nullable|string|max:255', // Validate location
            'gender' => 'nullable|string|max:50', // Validate gender
            'questions' => 'required|array', // Ensure questions are provided
            'questions.*.question_text' => 'required|string|max:255', // Validate each question text
            'questions.*.question_type' => 'required|string|in:dropdown,rating,checkbox,true-false', // Validate question type
            'questions.*.options' => 'nullable|array', // Validate options (if applicable)
        ]);

        // Create a new survey
        $survey = Survey::create([ // Ensure Survey model is used
            'user_id' => $request->input('user_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'created_at' => now(), // Set created_at to the current timestamp
        ]);

        // Loop through each question and save it to the database
        foreach ($request->input('questions') as $questionData) {
            $question = new Question([
                'question_text' => $questionData['question_text'],
                'question_type' => $questionData['question_type'],
                'options' => isset($questionData['options']) ? json_encode($questionData['options']) : null, // Convert options to JSON if necessary
                'survey_id' => $survey->id, // Associate the question with the newly created survey
            ]);
            
            $question->save(); // Save the question to the database
        }

        // Return a success response
        return redirect()->route('business')->with('success', 'Survey created successfully.');
    }
    protected function awardCredits($userId, $amount)
    {
        Credit::create([
            'user_id' => $userId,
            'amount' => $amount,
        ]);

}






public function showCredits()
{
    $credits = Credits::all(); // Fetch all records from the credits table
    dd($credits); // Dump and die to display the records
}






}