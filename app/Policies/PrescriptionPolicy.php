<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Prescription;
use App\Models\User;

class PrescriptionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Prescription');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Prescription $prescription): bool
    {
        return $user->can('view Prescription');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Prescription');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Prescription $prescription): bool
    {
        return $user->can('update Prescription');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Prescription $prescription): bool
    {
        return $user->can('delete Prescription');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Prescription $prescription): bool
    {
        return $user->can('restore Prescription');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Prescription $prescription): bool
    {
        return $user->can('force-delete Prescription');
    }
}
