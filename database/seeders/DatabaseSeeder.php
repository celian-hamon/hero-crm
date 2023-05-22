<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\enum\IncidentType;
use App\Models\Incident;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (IncidentType::values() as $name) {
           Incident::create([
                'name' => $name,
            ]);
        }
    }
}
