<?php

namespace App\Policies;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeavePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view leave requests
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Leave $leave): bool
    {
        // Users can view their own leave requests or if they're admin
        return $user->id === $leave->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create leave requests
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Leave $leave): bool
    {
        // Users can update their own pending leave requests
        return $user->id === $leave->user_id && $leave->status === 'pending';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Leave $leave): bool
    {
        // Users can delete their own pending leave requests
        return $user->id === $leave->user_id && $leave->status === 'pending';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Leave $leave): bool
    {
        return false; // No restore functionality needed
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Leave $leave): bool
    {
        return false; // No force delete functionality needed
    }

    /**
     * Determine whether the user can approve/reject the leave request.
     */
    public function approve(User $user, Leave $leave): bool
    {
        // Only admins can approve/reject leave requests
        return $user->isAdmin();
    }
}
