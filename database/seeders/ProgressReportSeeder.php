<?php

namespace Database\Seeders;

use App\Models\ProgressReport;
use App\Models\Sabbatical;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProgressReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activeSabbaticals = Sabbatical::where('status', 'active')->get();
        
        foreach ($activeSabbaticals as $sabbatical) {
            // Create 2-5 progress reports per active sabbatical
            $numReports = rand(2, 5);
            
            for ($i = 0; $i < $numReports; $i++) {
                $reportDate = Carbon::now()->subDays(rand(1, 30));
                
                ProgressReport::create([
                    'sabbatical_id' => $sabbatical->id,
                    'user_id' => $sabbatical->user_id,
                    'content' => $this->generateProgressReportContent(),
                    'report_date' => $reportDate,
                    'created_at' => $reportDate,
                ]);
            }
        }
    }

    /**
     * Generate realistic progress report content.
     */
    private function generateProgressReportContent(): string
    {
        $contents = [
            "This week I focused on shadowing senior surgeons during complex procedures. I observed several innovative techniques that I plan to implement in my practice upon return. The mentorship has been invaluable for understanding advanced surgical protocols.",
            
            "I completed the first phase of my research project on minimally invasive techniques. The preliminary results are promising, and I've established valuable connections with the research team here. Looking forward to presenting findings next month.",
            
            "Attended several conferences and workshops this month. The networking opportunities have been excellent, and I've learned about cutting-edge medical technologies that could benefit our hospital. Planning to submit a proposal for new equipment.",
            
            "Spent time in the emergency department observing their triage system. Their efficiency protocols are impressive and could be adapted for our facility. I've documented several best practices to share with our team.",
            
            "Continued my research collaboration with the neurology department. We've made significant progress on our joint study, and I'm excited about the potential publications. The cross-disciplinary approach has been enlightening.",
            
            "Participated in advanced training sessions for pediatric procedures. The techniques I've learned will be particularly valuable for our youngest patients. The hands-on experience has been transformative.",
            
            "Focused on telemedicine implementation strategies this week. I've been studying their remote consultation protocols and emergency response systems. This knowledge will be crucial for our rural outreach programs.",
            
            "Completed certification requirements for advanced surgical techniques. The training has been rigorous but rewarding. I'm confident these new skills will enhance our department's capabilities significantly.",
        ];

        return $contents[array_rand($contents)];
    }
} 