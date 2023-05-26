<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\enum\IncidentType;
use App\enum\StatusType;
use App\Models\Incident;
use App\Models\Status;
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
        foreach (StatusType::values() as $name) {
            Status::create([
                'name' => $name,
            ]);
        }
    }
}
