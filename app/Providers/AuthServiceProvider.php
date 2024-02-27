<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Destinatario;
use App\Models\Remitente;
use App\Models\Departamento;
use App\Models\Oficio;
use App\Models\StatusOficio;
use App\Models\User;
use App\Policies\DestinatarioPolicy;
use App\Policies\RemitentePolicy;
use App\Policies\DepartamentoPolicy;
use App\Policies\OficioPolicy;
use App\Policies\RolePolicy;
use App\Policies\PermissionPolicy;
use App\Policies\StatusOficioPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Contracts\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Destinatario::class => DestinatarioPolicy::class,
        Remitente::class => RemitentePolicy::class, 
        Departamento::class => DepartamentoPolicy::class,
        StatusOficio::class => StatusOficioPolicy::class,
        Oficio::class => OficioPolicy::class,
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
