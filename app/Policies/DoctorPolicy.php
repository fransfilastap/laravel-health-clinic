<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Doctor;
use App\Models\User;

class DoctorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Doctor');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Doctor $doctor): bool
    {
        return $user->can('view Doctor');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Doctor');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Doctor $doctor): bool
    {
        return $user->can('update Doctor');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Doctor $doctor): bool
    {
        return $user->can('delete Doctor');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Doctor $doctor): bool
    {
        return $user->can('restore Doctor');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Doctor $doctor): bool
    {
        return $user->can('force-delete Doctor');
    }
}
