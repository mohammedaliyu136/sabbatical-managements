<?php

namespace Database\Seeders;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        $leaveTypes = ['Vacation', 'Sick Leave', 'Personal', 'Unpaid'];
        $statuses = ['pending', 'approved', 'rejected'];

        // Create sample leave requests
        for ($i = 0; $i < 15; $i++) {
            $startDate = Carbon::now()->addDays(rand(1, 30));
            $endDate = $startDate->copy()->addDays(rand(1, 14));
            $status = $statuses[array_rand($statuses)];
            
            Leave::create([
                'user_id' => $user->id,
                'employee_name' => fake()->name(),
                'start_date' => $startDate,
                'end_date' => $endDate,
                'leave_type' => $leaveTypes[array_rand($leaveTypes)],
                'comments' => rand(0, 1) ? fake()->sentence() : null,
                'status' => $status,
                'approved_by' => $status !== 'pending' ? $user->id : null,
                'approved_at' => $status !== 'pending' ? Carbon::now()->subDays(rand(1, 7)) : null,
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
