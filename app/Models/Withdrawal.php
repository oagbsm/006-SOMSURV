<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    // Define the fillable properties for mass assignment
    protected $fillable = [
        'user_id',
        'amount',
        'method', // Add this line to include payment_method

    ];

    // Optionally, define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
