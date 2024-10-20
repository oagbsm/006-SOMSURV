<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Response;
use App\Models\Survey;
use App\Models\User;

class ResponsesTableSeeder extends Seeder
{
    public function run()
    {
        // Example of seeding responses for a survey
        $survey = Survey::first(); // Get the first survey (you can adjust this to fit your needs)
        $user = User::first(); // Get the first user

        // Seed multiple responses
        Response::create([
            'survey_id' => $survey->id,
            'user_id' => $user->id,
            'answers' => json_encode([
                'question_1' => 'Yes',
                'question_2' => 'No',
                'question_3' => 'Maybe',
            ]),
            'created_at' => now(),
        ]);

        Response::create([
            'survey_id' => $survey->id,
            'user_id' => $user->id + 1, // Another user
            'answers' => json_encode([
                'question_1' => 'No',
                'question_2' => 'Yes',
                'question_3' => 'I don\'t know',
            ]),
            'created_at' => now(),
        ]);
    }
}
