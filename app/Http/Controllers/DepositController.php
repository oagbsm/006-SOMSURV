<?php

namespace App\Http\Controllers;
use App\Models\Survey; 
use App\Models\Question; 
use App\Models\Credits; // Make sure to import the Credits model
use App\Models\Option; 
use App\Models\SupportTicket; 
use App\Models\DepositHistory; 

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
class DepositController extends Controller
{
    /**
     * Show the deposit form.
     */
    public function create()
    {
        return view('deposit.create');
    }

    /**
     * Handle the deposit request and store the deposit.
     */
    

    /**
     * Display the user's deposit history.
     */

}
