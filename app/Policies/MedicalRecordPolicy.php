<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\MedicalRecord;
use App\Models\User;

class MedicalRecordPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any MedicalRecord');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MedicalRecord $medicalrecord): bool
    {
        return $user->can('view MedicalRecord');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create MedicalRecord');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MedicalRecord $medicalrecord): bool
    {
        return $user->can('update MedicalRecord');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MedicalRecord $medicalrecord): bool
    {
        return $user->can('delete MedicalRecord');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MedicalRecord $medicalrecord): bool
    {
        return $user->can('restore MedicalRecord');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MedicalRecord $medicalrecord): bool
    {
        return $user->can('force-delete MedicalRecord');
    }
}
