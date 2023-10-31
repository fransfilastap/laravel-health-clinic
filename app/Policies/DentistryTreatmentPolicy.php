<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\DentistryTreatment;
use App\Models\User;

class DentistryTreatmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any DentistryTreatment');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DentistryTreatment $dentistrytreatment): bool
    {
        return $user->can('view DentistryTreatment');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create DentistryTreatment');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DentistryTreatment $dentistrytreatment): bool
    {
        return $user->can('update DentistryTreatment');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DentistryTreatment $dentistrytreatment): bool
    {
        return $user->can('delete DentistryTreatment');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DentistryTreatment $dentistrytreatment): bool
    {
        return $user->can('restore DentistryTreatment');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DentistryTreatment $dentistrytreatment): bool
    {
        return $user->can('force-delete DentistryTreatment');
    }
}
