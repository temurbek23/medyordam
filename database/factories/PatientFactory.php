<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition()
    {
        return [
			'firstname' => fake()->firstName(),
			'lastname' => fake()->lastName(),
			'password' => Hash::make('12345678'),
			'email' => fake()->safeEmail(),
			'contact' => fake()->phoneNumber(),
        ];
    }
}
