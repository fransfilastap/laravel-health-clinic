<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Medicine;
use App\Models\User;

class MedicinePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Medicine');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Medicine $medicine): bool
    {
        return $user->can('view Medicine');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Medicine');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Medicine $medicine): bool
    {
        return $user->can('update Medicine');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Medicine $medicine): bool
    {
        return $user->can('delete Medicine');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Medicine $medicine): bool
    {
        return $user->can('restore Medicine');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Medicine $medicine): bool
    {
        return $user->can('force-delete Medicine');
    }
}
