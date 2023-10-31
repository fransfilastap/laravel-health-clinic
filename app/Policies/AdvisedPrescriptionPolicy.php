<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\AdvisedPrescription;
use App\Models\User;

class AdvisedPrescriptionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any AdvisedPrescription');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AdvisedPrescription $advisedprescription): bool
    {
        return $user->can('view AdvisedPrescription');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create AdvisedPrescription');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AdvisedPrescription $advisedprescription): bool
    {
        return $user->can('update AdvisedPrescription');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AdvisedPrescription $advisedprescription): bool
    {
        return $user->can('delete AdvisedPrescription');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AdvisedPrescription $advisedprescription): bool
    {
        return $user->can('restore AdvisedPrescription');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AdvisedPrescription $advisedprescription): bool
    {
        return $user->can('force-delete AdvisedPrescription');
    }
}
