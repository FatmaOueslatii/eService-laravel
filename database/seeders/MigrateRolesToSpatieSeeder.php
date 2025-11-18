<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class MigrateRolesToSpatieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Créer les rôles dans Spatie
        Role::create(['name' => 'admin', 'label' => 'Administrateur']);
        Role::create(['name' => 'agent', 'label' => 'Agent']);
        Role::create(['name' => 'client', 'label' => 'Client']);

        // Assigner les rôles aux utilisateurs existants
        // Si vous aviez une colonne role_id ou role_name dans users
        User::chunk(100, function ($users) {
            foreach ($users as $user) {
                // Adaptez selon votre ancienne structure
                // Option 1 : si vous aviez role_id
                if (isset($user->role_id)) {
                    switch ($user->role_id) {
                        case 1:
                            $user->assignRole('admin');
                            break;
                        case 2:
                            $user->assignRole('agent');
                            break;
                        case 3:
                            $user->assignRole('client');
                            break;
                    }
                }

                // Option 2 : si vous aviez une relation role->name
                // if ($user->role) {
                //     $user->assignRole($user->role->name);
                // }
            }
        });
    }
}
