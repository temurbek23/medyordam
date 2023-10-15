<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Disease;
use App\Models\Doctor;
use App\Models\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            DiseaseSeeder::class,
            DoctorSeeder::class,
            FirstAidSeeder::class,
            PatientSeeder::class,
            ProfessionSeeder::class,
            SymptomSeeder::class,
            CallHistorySeeder::class,
        ]);

        $doctors = Doctor::all();
        foreach ($doctors as $doctor)
            for ($i = 0; $i < 3; $i++)
                $doctor->professions()->attach(rand(1, 20));

        $diseases = Disease::all();
        foreach ($diseases as $disease)
            for ($i = 0; $i < 3; $i++)
                $disease->symptoms()->attach(rand(1, 20));
    }
}
