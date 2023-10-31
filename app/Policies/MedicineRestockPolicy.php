<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\MedicineRestock;
use App\Models\User;

class MedicineRestockPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any MedicineRestock');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MedicineRestock $medicinerestock): bool
    {
        return $user->can('view MedicineRestock');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create MedicineRestock');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MedicineRestock $medicinerestock): bool
    {
        return $user->can('update MedicineRestock');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MedicineRestock $medicinerestock): bool
    {
        return $user->can('delete MedicineRestock');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MedicineRestock $medicinerestock): bool
    {
        return $user->can('restore MedicineRestock');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MedicineRestock $medicinerestock): bool
    {
        return $user->can('force-delete MedicineRestock');
    }
}
