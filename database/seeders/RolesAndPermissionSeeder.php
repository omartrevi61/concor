<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // USER MODEL
        $userPermission1 = Permission::create(['name' => 'crear_usuario']);
        $userPermission2 = Permission::create(['name' => 'editar_usuario']);
        $userPermission3 = Permission::create(['name' => 'eliminar_usuario']);
        $userPermission4 = Permission::create(['name' => 'ver_usuario']);

        // ROLE MODEL
        $rolePermission1 = Permission::create(['name' => 'crear_role']);
        $rolePermission2 = Permission::create(['name' => 'editar_role']);
        $rolePermission3 = Permission::create(['name' => 'eliminar_role']);
        $rolePermission4 = Permission::create(['name' => 'ver_role']);

        // PERMISSION MODEL
        $permission1 = Permission::create(['name' => 'crear_permiso']);
        $permission2 = Permission::create(['name' => 'editar_permiso']);
        $permission3 = Permission::create(['name' => 'eliminar_permiso']);
        $permission4 = Permission::create(['name' => 'ver_permiso']);

        // Destinatario MODEL
        $destinatarioPermission1 = Permission::create(['name' => 'crear_destinatario']);
        $destinatarioPermission2 = Permission::create(['name' => 'editar_destinatario']);
        $destinatarioPermission3 = Permission::create(['name' => 'eliminar_destinatario']);
        $destinatarioPermission4 = Permission::create(['name' => 'ver_destinatario']);

        // Remitente MODEL
        $remitentePermission1 = Permission::create(['name' => 'crear_remitente']);
        $remitentePermission2 = Permission::create(['name' => 'editar_remitente']);
        $remitentePermission3 = Permission::create(['name' => 'eliminar_remitente']);
        $remitentePermission4 = Permission::create(['name' => 'ver_remitente']);

        // Departamento MODEL
        $departamentoPermission1 = Permission::create(['name' => 'crear_departamento']);
        $departamentoPermission2 = Permission::create(['name' => 'editar_departamento']);
        $departamentoPermission3 = Permission::create(['name' => 'eliminar_departamento']);
        $departamentoPermission4 = Permission::create(['name' => 'ver_departamento']);

        // StatusOficio MODEL
        $statusPermission1 = Permission::create(['name' => 'crear_status']);
        $statusPermission2 = Permission::create(['name' => 'editar_status']);
        $statusPermission3 = Permission::create(['name' => 'eliminar_status']);
        $statusPermission4 = Permission::create(['name' => 'ver_status']);

        // Oficio MODEL
        $oficioPermission1 = Permission::create(['name' => 'crear_oficio']);
        $oficioPermission2 = Permission::create(['name' => 'editar_oficio']);
        $oficioPermission3 = Permission::create(['name' => 'eliminar_oficio']);
        $oficioPermission4 = Permission::create(['name' => 'ver_oficio']);

        $superAdminRole = Role::create(['name' => 'Administrador'])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $destinatarioPermission1,
            $destinatarioPermission2,
            $destinatarioPermission3,
            $destinatarioPermission4,
            $remitentePermission1,
            $remitentePermission2,
            $remitentePermission3,
            $remitentePermission4,
            $departamentoPermission1,
            $departamentoPermission2,
            $departamentoPermission3,
            $departamentoPermission4,
            $statusPermission1,
            $statusPermission2,
            $statusPermission3,
            $statusPermission4,
            $oficioPermission1,
            $oficioPermission2,
            $oficioPermission3,
            $oficioPermission4,
        ]);

        $operadorRole = Role::create(['name' => 'Operador'])->syncPermissions([
            $destinatarioPermission1,
            $destinatarioPermission2,
            $destinatarioPermission4,
            $remitentePermission1,
            $remitentePermission2,
            $remitentePermission4,
            $departamentoPermission1,
            $departamentoPermission2,
            $departamentoPermission4,
            $statusPermission1,
            $statusPermission2,
            $statusPermission4,
            $oficioPermission1,
            $oficioPermission2,
            $oficioPermission4,
        ]);

        // CREATE USERS
        User::create([
            'name' => 'Omar Treviño',
            'email' => 'omar-trevino@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($superAdminRole);
    }
}
