<?php

namespace App\Http\Controllers;
use App\Models\Survey; 
use App\Models\Question; 
use App\Models\Credits; // Make sure to import the Credits model
use App\Models\Option; 
use App\Models\SupportTicket; 

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

class BusinessController extends Controller
{

    public function businessdashboard()
    {
        $user = auth()->user();
        $userId=$user;
        // Retrieve the user's balance (if needed)
        $balance = Balance::where('user_id', auth()->id())->first();
        // Count total surveys for the user
        $totalSurveys = Survey::where('user_id', $user->id)->count();
    
        // Count total responses related to the user's surveys
        $totalResponses = Response::whereHas('survey', function ($query) use ($user) {
            $query->where('user_id', $user->id); // Assuming 'user_id' is the foreign key in the surveys table
        })->count();
    
        // Fetch the latest 5 responses related to the user's surveys
        $latestResponses = Response::whereHas('survey', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->latest() // Orders by the most recent responses
        ->take(5)  // Get only the 5 latest responses
        ->get();
    
        
        // Add the "time ago" for each response
        $latestResponses->map(function ($response) {
            $response->timeAgo = Carbon::parse($response->created_at)->diffForHumans();
            return $response;
        });
        $latestResponses->map(function ($response) {




            
            // Get the age and gender from user_profile based on user_id
            $userProfile = UserProfile::where('userid', $response->user_id)->first();

            if ($userProfile) {
                $response->age = $userProfile->age;
                $response->gender = $userProfile->gender;
                $response->city = $userProfile->city;

            } else {
                // If no profile is found, assign default values
                $response->age = 'Unknown';
                $response->gender = 'Unknown';
            }

            // Calculate the "time ago" for the response

        });

        







        $surveys = Survey::where('user_id', $user->id)->get(); // Fetch surveys created by the user
        $responsesByHour = Response::whereHas('survey', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->selectRaw('HOUR(CONVERT_TZ(created_at, "+00:00", "' . config('app.timezone') . '")) as hour, COUNT(*) as count')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();
// dd($responsesByHour);
            // dd($responsesByHour); // Add this line to check the data

        // Prepare data for the chart
        $responseData = array_fill(0, 24, 0); // Initialize an array of 24 zeros (hours)
        
        foreach ($responsesByHour as $response) {
            $responseData[$response->hour] = $response->count;
        }
    
        // dd($responseData);
        // Pass all data to the dashboard view
        return view('business.dashboard', [
            'balance' => $balance,
            'totalSurveys' => $totalSurveys,
            'totalResponses' => $totalResponses,
            'latestResponses' => $latestResponses,
            'responseData' => $responseData,
            'surveys' => $surveys,
        ]);
    }
    
    public function viewsurvey()
    {
                // Get the currently authenticated user
                {
                    $user = auth()->user();
                    

                    // Retrieve the specific survey with its questions and options
                    $surveys = Survey::where('user_id', Auth::id())->get();
                    $totalSurveys = Survey::where('user_id', $user->id)->count();
    
                    // Count total responses related to the user's surveys
                    $totalResponses = Response::whereHas('survey', function ($query) use ($user) {
                        $query->where('user_id', $user->id); // Assuming 'user_id' is the foreign key in the surveys table
                    })->count();
                    
                

                
                    return view('business.view-survey', compact('surveys','totalSurveys','totalResponses'));
                }
        // Return the view with survey data
    }


    public function viewsurveydetail($id)
    {
        $survey = Survey::with('questions.options')->findOrFail($id);
        return view('business.view-survey-detail', compact('survey'));
    }


    public function destroy($id)
    {
        // Retrieve the survey by its ID
        $survey = Survey::findOrFail($id);

        // Delete the survey
        $survey->delete();

        // Redirect back to the surveys list with a success message
        return redirect()->back()->with('success', 'Survey deleted successfully.');
    }

    public function analytics()
{
    $userId = Auth::id();
    
    // Fetch surveys created by the user
    $surveys = Survey::where('user_id', $userId)->get();
    
    // Prepare an array to store analytics data
    $analytics = [];

    // Process each survey
    foreach ($surveys as $survey) {
        // Fetch responses for each survey
        $responses = Response::where('survey_id', $survey->id)->get();

        // Initialize analytics for each survey
        $analytics[$survey->id] = [
            'survey_name' => $survey->survey_name,
            'responses_count' => $responses->count(), // Directly count responses
            'questions' => [],
        ];

        // Fetch survey questions related to this survey
        $surveyQuestions = Question::where('survey_id', $survey->id)->get();

        // Process each response
        foreach ($responses as $response) {
            // Get the question ID and selected option ID from the response
            $questionId = $response->question_id;
            $optionId = $response->option_id;

            // Fetch the question text and type using the question ID
            $question = $surveyQuestions->firstWhere('id', $questionId);
            $questionText = $question->question_text ?? 'Unknown Question';
            $questionType = $question->question_type ?? 'unknown';

            // Initialize analytics for each question if not already set
            if (!isset($analytics[$survey->id]['questions'][$questionId])) {
                $analytics[$survey->id]['questions'][$questionId] = [
                    'question_text' => $questionText,
                    'question_type' => $questionType, // Add the question type
                    'answers' => [],
                    'total_responses' => 0, // Initialize total_responses
                ];
            }

            // Store the answer (option ID) and increment the total responses count for the question
            if ($optionId) {
                // Assuming options are represented by IDs and you want to store the option ID
                $analytics[$survey->id]['questions'][$questionId]['answers'][] = $optionId;
            }

            // Increment the total responses count for the question
            $analytics[$survey->id]['questions'][$questionId]['total_responses']++;
        }
    }

    // Pass the analytics data to the view
    return view('business.view-analytics', compact('surveys', 'analytics'));
}




}
