<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\LabExamination;
use App\Models\User;

class LabExaminationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any LabExamination');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LabExamination $labexamination): bool
    {
        return $user->can('view LabExamination');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create LabExamination');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LabExamination $labexamination): bool
    {
        return $user->can('update LabExamination');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LabExamination $labexamination): bool
    {
        return $user->can('delete LabExamination');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LabExamination $labexamination): bool
    {
        return $user->can('restore LabExamination');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LabExamination $labexamination): bool
    {
        return $user->can('force-delete LabExamination');
    }
}
