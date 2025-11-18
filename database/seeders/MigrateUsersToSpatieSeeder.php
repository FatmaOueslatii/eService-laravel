<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as SpatieRole;


class MigrateUsersToSpatieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer tous les utilisateurs qui ont un role_id
        User::whereNotNull('role_id')->chunk(100, function ($users) {
            foreach ($users as $user) {
                // Trouver le nom du rôle depuis l'ancienne table
                $oldRole = \DB::table('roles')->where('id', $user->role_id)->first();

                if ($oldRole) {
                    // Assigner le rôle via Spatie
                    $user->assignRole($oldRole->name);

                    echo "✅ User {$user->name} assigné au rôle {$oldRole->name}\n";
                }
            }
        });

        echo "✅ Migration terminée !\n";
}}
