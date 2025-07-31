<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // Create doctor users
        User::factory()->create([
            'name' => 'Dr. Sarah Johnson',
            'email' => 'sarah.johnson@hospital.com',
            'role' => 'doctor',
        ]);

        User::factory()->create([
            'name' => 'Dr. Michael Chen',
            'email' => 'michael.chen@hospital.com',
            'role' => 'doctor',
        ]);

        User::factory()->create([
            'name' => 'Dr. Emily Rodriguez',
            'email' => 'emily.rodriguez@hospital.com',
            'role' => 'doctor',
        ]);

        User::factory()->create([
            'name' => 'Dr. David Thompson',
            'email' => 'david.thompson@hospital.com',
            'role' => 'doctor',
        ]);

        User::factory()->create([
            'name' => 'Dr. Lisa Wang',
            'email' => 'lisa.wang@hospital.com',
            'role' => 'doctor',
        ]);
    }
}
