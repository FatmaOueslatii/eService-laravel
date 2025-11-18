<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer les permissions
        Permission::create(['name' => 'view-users']);
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'view-reports']);
        Permission::create(['name' => 'create-reports']);

        // Créer les rôles
        $admin = Role::create(['name' => 'admin']);
        $agent = Role::create(['name' => 'agent']);
        $user = Role::create(['name' => 'user']);

        // Assigner toutes les permissions à admin
        $admin->givePermissionTo(Permission::all());

        // Manager peut voir et éditer
        $agent->givePermissionTo(['view-users', 'edit-users', 'view-reports']);

        // User peut seulement voir
        $user->givePermissionTo(['view-reports']);
    }
}
