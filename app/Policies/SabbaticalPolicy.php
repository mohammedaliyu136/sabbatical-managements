<?php

namespace App\Policies;

use App\Models\Sabbatical;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SabbaticalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Both admins and doctors can view sabbaticals
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Sabbatical $sabbatical): bool
    {
        return $user->isAdmin() || $user->id === $sabbatical->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isDoctor();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Sabbatical $sabbatical): bool
    {
        return $user->isAdmin() || ($user->isDoctor() && $user->id === $sabbatical->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Sabbatical $sabbatical): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can submit progress reports.
     */
    public function submitReport(User $user, Sabbatical $sabbatical): bool
    {
        return $user->isDoctor() && $user->id === $sabbatical->user_id && $sabbatical->status === 'active';
    }

    /**
     * Determine whether the user can approve sabbaticals.
     */
    public function approve(User $user, Sabbatical $sabbatical): bool
    {
        return $user->isAdmin();
    }
} 