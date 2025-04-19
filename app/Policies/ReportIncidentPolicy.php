<?php

namespace App\Policies;

use App\Models\ReportIncident;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReportIncidentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'student']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ReportIncident $reportIncident): bool
    {
        return $user->id === $reportIncident->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ReportIncident $reportIncident): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ReportIncident $reportIncident): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ReportIncident $reportIncident): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ReportIncident $reportIncident): bool
    {
        //
    }
}
