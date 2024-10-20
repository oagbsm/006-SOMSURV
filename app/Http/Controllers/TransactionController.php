<?php

namespace App\Http\Controllers;
use App\Models\Survey; 
use App\Models\Question; 
use App\Models\Credits; // Make sure to import the Credits model
use App\Models\Option; 
use App\Models\SupportTicket; 
use App\Models\Withdrawal; // Ensure to import the Withdrawal model
use App\Models\DepositHistory; // Import the Deposit model

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
class TransactionController extends Controller


{
 //Withdraw Credits
    public function processWithdraw(Request $request)

    {
          
                // dd($request);
                $user = Auth::user();
                // dd($user);
                // Check if the user has a credits entry; if not, create it with a default balance of 0
                if (!$user->credits) {
                    $user->credits()->save(new Credits(['amount' => 0]));
                }
            
                // Retrieve the current balance after ensuring the credits entry exists
                $currentBalance = $user->credits->amount; // Explicitly cast to float
                $amount = (float) $request->amount;
                $method = $request->method;
                // Validate the form inputs - ensure the amount is valid
                if ($amount > $currentBalance) {
                    return back()->with('error', 'balance no enough. New balance: ' . $user->credits->amount);   
                }
    
                // Update the user's credit balance
                $user->credits->amount -= $request->amount;
                $user->credits->save();  // Save the updated balance
                Withdrawal::create([
                    'user_id' => $user->id,
                    'amount' => $amount,
                    'method'=>$method,
                    
                ]);
                // Optional: Return a success message or redirect
                return back()->with('success', 'Withdrawal successful. New balance: ' . $user->credits->amount);   
    }
    
    public function showWithdrawForm()
    {
        return view('user.withdraw'); // This will show the withdraw page you created
    }   

    public function withdrawHistory()
    {
        $user = Auth::user();

        // Retrieve the withdrawal history for the authenticated user
        $withdrawals = Withdrawal::where('user_id', $user->id)
        ->select('id', 'amount', 'method', 'created_at') // Select necessary columns
        ->orderBy('created_at', 'desc') // Order by latest date first
        ->get();

            // dd($withdrawals);
        // Return the view with the withdrawal history
        return view('user.withdrawhistory', compact('withdrawals'));
    } 
 //DEPOSIT MONEYS
    public function createDeposit(Request $request)
    {
        // Validate the deposit request
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required',
            'transaction_id' => 'nullable|string',
        ]);

        $user = Auth::user(); // Get the current logged-in user
        
        // Get the user's current balance or create a new one
        $balance = Balance::firstOrCreate(
            ['user_id' => $user->id],
            ['balance' => 0]
        );

        // Update the user's balance
        $balance->balance += $request->input('amount');
        $balance->save();
        DepositHistory::create([
            'user_id' => $user->id,
            'amount' => $request->input('amount'),
            'payment_method' => $request->input('payment_method'),
            'transaction_id' => $request->input('transaction_id'),
        ]);
        // Redirect or return a success message
        return redirect()->route('business')->with('success', 'Deposit successful! Your balance has been updated.');
    }
    public function deposithistory()
    {
        $user = Auth::user();
        $depositHistory = DepositHistory::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        // dd($depositHistory);

        
        return view('business.deposit-history', compact('depositHistory'));
    }




}
