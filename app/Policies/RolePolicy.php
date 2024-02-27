<?php

namespace App\Policies;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Auth\Access\Response;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Administrador']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Administrador']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        return $user->hasAnyRole(['Administrador']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        return $user->hasAnyRole(['Administrador']);
    }

}
