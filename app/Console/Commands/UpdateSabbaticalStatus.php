<?php

namespace App\Console\Commands;

use App\Models\Sabbatical;
use Illuminate\Console\Command;

class UpdateSabbaticalStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sabbaticals:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update sabbatical statuses based on current date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating sabbatical statuses...');

        $sabbaticals = Sabbatical::all();
        $updated = 0;

        foreach ($sabbaticals as $sabbatical) {
            $oldStatus = $sabbatical->status;
            $sabbatical->updateStatus();
            
            if ($sabbatical->status !== $oldStatus) {
                $this->line("Updated sabbatical ID {$sabbatical->id} from '{$oldStatus}' to '{$sabbatical->status}'");
                $updated++;
            }
        }

        $this->info("Updated {$updated} sabbatical statuses.");
        
        // Show current status counts
        $upcoming = Sabbatical::upcoming()->count();
        $active = Sabbatical::active()->count();
        $completed = Sabbatical::completed()->count();
        
        $this->table(
            ['Status', 'Count'],
            [
                ['Upcoming', $upcoming],
                ['Active', $active],
                ['Completed', $completed],
            ]
        );
    }
}
