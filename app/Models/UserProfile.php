<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    // Define the table if it's not the plural form of the model name
    protected $table = 'user_profile'; // Optional if the table name matches the plural form of the model

    // Specify the fillable fields
    protected $fillable = [
        'userid',
        'age',
        'gender',
        'city',
        'country',
        'region',
        'education_level',
        'telecom1',
        'telecom2',
        'mobile_money1',
        'mobile_money2',
        'nationality1',
        'bank1',
        'bank2',
        'employment_status',
        'salary_range',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Optionally, you can define relationships or any custom methods here
}
