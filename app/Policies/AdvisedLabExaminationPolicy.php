<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\AdvisedLabExamination;
use App\Models\User;

class AdvisedLabExaminationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any AdvisedLabExamination');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AdvisedLabExamination $advisedlabexamination): bool
    {
        return $user->can('view AdvisedLabExamination');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create AdvisedLabExamination');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AdvisedLabExamination $advisedlabexamination): bool
    {
        return $user->can('update AdvisedLabExamination');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AdvisedLabExamination $advisedlabexamination): bool
    {
        return $user->can('delete AdvisedLabExamination');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AdvisedLabExamination $advisedlabexamination): bool
    {
        return $user->can('restore AdvisedLabExamination');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AdvisedLabExamination $advisedlabexamination): bool
    {
        return $user->can('force-delete AdvisedLabExamination');
    }
}
