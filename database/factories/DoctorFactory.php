<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition()
    {
        return [
			'firstname' => fake()->firstName(),
			'lastname' => fake()->lastName(),
			'password' => Hash::make('12345678'),
			'email' => fake()->safeEmail(),
			'contact' => fake()->phoneNumber(),
			'main_profession' => fake()->text(5),
			'photo' => fake()->imageUrl(),
			'about' => fake()->text(),
			'education' => fake()->text(),
			'practice' => fake()->text(),
			'practice_in_years' => rand(0, 50),
			'residency' => fake()->text(),
        ];
    }
}
