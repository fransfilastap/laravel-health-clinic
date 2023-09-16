<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\LabRegistry;
use App\Models\User;

class LabRegistryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any LabRegistry');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LabRegistry $labregistry): bool
    {
        return $user->can('view LabRegistry');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create LabRegistry');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LabRegistry $labregistry): bool
    {
        return $user->can('update LabRegistry');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LabRegistry $labregistry): bool
    {
        return $user->can('delete LabRegistry');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LabRegistry $labregistry): bool
    {
        return $user->can('restore LabRegistry');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LabRegistry $labregistry): bool
    {
        return $user->can('force-delete LabRegistry');
    }
}
