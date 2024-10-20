<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositHistory extends Model
{
    use HasFactory;

    protected $table = 'deposit_history';

    protected $fillable = [
        'user_id',
        'amount',
        'payment_method',
        'transaction_id',
    ];
}
