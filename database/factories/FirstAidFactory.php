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
			
			'case' => $this->faker->word,
			'photo' => $this->faker->word,
			'treatment' => $this->faker->sentence,
			
			

        ];
    }
}
