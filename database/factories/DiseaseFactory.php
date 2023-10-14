<?php

namespace Database\Factories;

use App\Models\Disease;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiseaseFactory extends Factory
{
    protected $model = Disease::class;

    public function definition()
    {
        return [
			
			'name' => $this->faker->word,
			'treatment' => $this->faker->sentence,
			
			

        ];
    }
}
