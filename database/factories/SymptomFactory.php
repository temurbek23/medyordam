<?php

namespace Database\Factories;

use App\Models\Symptom;
use Illuminate\Database\Eloquent\Factories\Factory;

class SymptomFactory extends Factory
{
    protected $model = Symptom::class;

    public function definition()
    {
        return [
			
			'name' => $this->faker->word,
			
			

        ];
    }
}
