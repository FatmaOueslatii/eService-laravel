<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class FixRolesSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Nettoyer complètement la table model_has_roles
        DB::table('model_has_roles')->truncate();

        echo "\u{2716} Table model_has_roles nettoyée\n";

        // 2. Vérifier que les rôles existent
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $agentRole = Role::firstOrCreate(['name' => 'agent', 'guard_name' => 'web']);
        $clientRole = Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);

        echo "\u{2716} Rôles créés/vérifiés\n";

        // 3. Assigner les rôles proprement
        $assignments = [
            'agent1@hotmail.com' => 'agent',
            'client1@gmail.com' => 'client',
            'test1@gmail.com' => 'admin',
            'agent2@gmail.com' => 'agent',
            'client2@gmail.com' => 'client',
            'spatie@gmail.com' => 'admin',
        ];

        foreach ($assignments as $email => $roleName) {
            $user = User::where('email', $email)->first();

            if ($user) {
                // Retirer tous les rôles existants
                DB::table('model_has_roles')
                    ->where('model_id', $user->id)
                    ->where('model_type', User::class)
                    ->delete();

                // Assigner le nouveau rôle
                $user->assignRole($roleName);

                // Vérification
                $hasRole = $user->hasRole($roleName);
                $status = $hasRole ? "\u{2716}" : "\u{2718}";
                echo "{$status} {$email} -> {$roleName} (hasRole: " . ($hasRole ? 'YES' : 'NO') . ")\n";
            } else {
                echo "\u{2718}  User {$email} not found\n";
            }
        }

        echo "\n\u{1F4DC} État final de model_has_roles:\n";
        $roles = DB::table('model_has_roles')->get();
        foreach ($roles as $role) {
            $user = User::find($role->model_id);
            $roleName = Role::find($role->role_id)->name ?? 'unknown';
            echo "   User #" . $role->model_id
                . " (" . ($user->email ?? 'N/A') . ")"
                . " -> Role: " . $roleName . "\n";
        }
    }
}
