<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
			'firstname' => fake()->firstName(),
			'lastname' => fake()->lastName(),
			'password' => Hash::make('12345678'),
			'email' => fake()->safeEmail(),
        ];
    }
}
