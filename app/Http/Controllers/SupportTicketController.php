<?php
namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    // Show form to create a new support ticket
    public function create()
    {
        return view('business.ticket'); // Assuming you have a view for creating tickets
    }

    // Store a new support ticket
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        SupportTicket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
        ]);

        return redirect()->route('business.ticket')->with('success', 'Ticket created successfully');
    }

    // Optional: Add other methods like show, index, update, etc.
}
