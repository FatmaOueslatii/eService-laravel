<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'marketing', 'label' => 'Service Marketing'],
            ['name' => 'informatique', 'label' => 'Service Informatique'],
            ['name' => 'commercial', 'label' => 'Service Commercial'],
            ['name' => 'rh', 'label' => 'Ressources Humaines'],
            ['name' => 'comptabilite', 'label' => 'Service Comptabilité'],
            ['name' => 'direction', 'label' => 'Direction Générale'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
