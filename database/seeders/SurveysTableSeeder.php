<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Survey;

class SurveysTableSeeder extends Seeder
{
    public function run()
    {
        Survey::create([
            'user_id' => 3, // Replace with an actual user ID
            'title' => 'Customer Satisfaction Survey',
            'credits' => 12, // The number of credits awarded for this survey
            'respondent_limit' => 100, // Maximum number of respondents
            'status' => 'active', // Status of the survey

            'created_at' => now(),
        ]);

        Survey::create([
            'user_id' => 3, // Replace with another actual user ID
            'title' => 'Miglo Food Review',
            'credits' => 10, // The number of credits awarded for this survey
            'respondent_limit' => 200, // Maximum number of respondents
            'status' => 'active', // Status of the survey

            'created_at' => now(),
        ]);
    }
}
