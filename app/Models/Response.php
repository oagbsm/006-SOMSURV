<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    
        use HasFactory;
            // Specify the table name if it differs from the default (optional)
            protected $table = 'responses';
    
            // If you want to allow mass assignment, define fillable fields
            protected $fillable = ['survey_id', 'formatted_answers','user_id'];

            public function survey()
            {
                return $this->belongsTo(Survey::class);
            }
            public function user()
            {
                return $this->belongsTo(User::class);
            }
            public function question()
            {
        return $this->belongsTo(Question::class);
            }
            public function option()
{
    return $this->belongsTo(Option::class);
}
    }
