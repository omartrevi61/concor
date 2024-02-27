<?php

namespace App\Policies;

use App\Models\Destinatario;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DestinatarioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Administrador', 'Operador', 'Consultor']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Administrador', 'Operador']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Destinatario $destinatario): bool
    {
        return $user->hasAnyRole(['Administrador', 'Operador']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Destinatario $destinatario): bool
    {
        return $user->hasAnyRole(['Administrador']);
    }
}
