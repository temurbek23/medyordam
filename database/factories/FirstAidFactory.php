<?php

namespace Database\Factories;

use App\Models\FirstAid;
use Illuminate\Database\Eloquent\Factories\Factory;

class FirstAidFactory extends Factory
{
    protected $model = FirstAid::class;

    public function definition()
    {
        return [
			'case' => fake()->text(50),
			'photo' => fake()->imageUrl(),
			'treatment' => fake()->text(300),
        ];
    }
}
