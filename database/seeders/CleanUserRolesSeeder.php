<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CleanUserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            'agent1@hotmail.com' => 'agent',
            'client1@gmail.com' => 'client', // Enlever admin
            'test1@gmail.com' => 'admin',    // Enlever client
            'agent2@gmail.com' => 'agent',
            'client2@gmail.com' => 'client',
            'spatie@gmail.com' => 'admin',
        ];

        foreach ($users as $email => $role) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->syncRoles([$role]); // Remplace tous les rôles par un seul
                echo "✅ {$email} -> {$role}\n";
            }
        }
    }
}
