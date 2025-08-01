<?php

namespace App\Policies;

use App\Models\ProgressReport;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgressReportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProgressReport $report): bool
    {
        return $user->isAdmin() || $user->id === $report->user_id;
    }

    /**
     * Determine whether the user can submit progress reports.
     */
    public function submitReport(User $user, Sabbatical $sabbatical): bool
    {
        return $user->isDoctor() && 
               $user->id === $sabbatical->user_id && 
               $sabbatical->status === 'active' && 
               $sabbatical->approval_status === 'approved';
    }
} 