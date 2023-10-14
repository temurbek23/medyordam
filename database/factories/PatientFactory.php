<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition()
    {
        return [
			
			'firstname' => $this->faker->word,
			'lastname' => $this->faker->word,
			'password' => $this->faker->word,
			'email' => $this->faker->word,
			'contact' => $this->faker->word,
			
			

        ];
    }
}
