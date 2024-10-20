<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'priority',
        'message',
        'attachment',
        'user_id', // Add user_id here
    ];

    // Other model methods and properties...
}
