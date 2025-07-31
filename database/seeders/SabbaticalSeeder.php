<?php

namespace Database\Seeders;

use App\Models\Sabbatical;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SabbaticalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = User::where('role', 'doctor')->get();
        
        if ($doctors->isEmpty()) {
            // Create some doctor users if none exist
            $doctors = User::factory(5)->create([
                'role' => 'doctor',
            ]);
        }

        $destinations = [
            'Harvard Medical School, Boston',
            'Johns Hopkins University, Baltimore',
            'Stanford University, California',
            'Mayo Clinic, Rochester',
            'Cleveland Clinic, Ohio',
            'Massachusetts General Hospital, Boston',
            'UCLA Medical Center, Los Angeles',
            'Mount Sinai Hospital, New York',
        ];

        $purposes = [
            'Research in cardiovascular surgery techniques',
            'Advanced training in minimally invasive procedures',
            'Study of innovative cancer treatment protocols',
            'Professional development in emergency medicine',
            'Research collaboration in neurology',
            'Advanced certification in pediatric surgery',
            'Study of telemedicine implementation strategies',
            'Research in medical device innovation',
        ];

        $updateFrequencies = ['weekly', 'monthly', 'quarterly'];
        $statuses = ['upcoming', 'active', 'completed'];
        $approvalStatuses = ['pending', 'approved', 'rejected'];

        foreach ($doctors as $doctor) {
            // Create 1-2 sabbaticals per doctor
            $numSabbaticals = rand(1, 2);
            
            for ($i = 0; $i < $numSabbaticals; $i++) {
                $startDate = Carbon::now()->addDays(rand(-30, 60));
                $endDate = $startDate->copy()->addDays(rand(30, 180));
                $status = $statuses[array_rand($statuses)];
                $approvalStatus = $approvalStatuses[array_rand($approvalStatuses)];
                
                Sabbatical::create([
                    'user_id' => $doctor->id,
                    'destination' => $destinations[array_rand($destinations)],
                    'purpose' => $purposes[array_rand($purposes)],
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'update_frequency' => $updateFrequencies[array_rand($updateFrequencies)],
                    'status' => $status,
                    'approval_status' => $approvalStatus,
                    'created_at' => Carbon::now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
} 