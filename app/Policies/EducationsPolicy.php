<?php

namespace App\Policies;

use App\Models\Educations;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EducationsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true; // Anyone can view the list of articles
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Educations $education): bool
    {
        return true; // Anyone can view individual articles
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Any authenticated user can create articles
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Educations $education): bool
    {
        return $user->id === $education->user_id; // Only the author can update
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Educations $education): bool
    {
        return $user->id === $education->user_id; // Only the author can delete
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Educations $educations): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Educations $educations): bool
    {
        return false;
    }
}
