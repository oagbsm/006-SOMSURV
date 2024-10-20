<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BalancesTableSeeder extends Seeder
{
    public function run()
    {
        // Get all user IDs from the users table
        $userIds = DB::table('users')->pluck('id')->toArray();

        // Ensure we have user IDs to work with
        if (empty($userIds)) {
            Log::warning('No users found to assign balances.');
            return;
        }

        // Loop through each user ID and create a balance record
        foreach ($userIds as $userId) {
            DB::table('balances')->insert([
                'user_id' => $userId,
                'balance' => rand(1000, 5000) / 100, // Random balance between 10.00 and 50.00
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
