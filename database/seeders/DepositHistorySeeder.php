<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DepositHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example deposit history data
        $deposits = [
            [
                'user_id' => 3, // Assuming user with ID 1 exists
                'amount' => 500,
                'payment_method' => 'mobile-money1', // Replace with actual methods
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'amount' => 300,
                'payment_method' => 'bank1',
                'status' => 'pending',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'user_id' => 3,
                'amount' => 1000,
                'payment_method' => 'bank2',
                'status' => 'failed',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            // Add more entries as needed
        ];

        // Insert deposit history data into the database
        DB::table('deposit_history')->insert($deposits);
    }
}
