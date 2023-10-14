<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition()
    {
        return [
			
			'firstname' => $this->faker->word,
			'lastname' => $this->faker->word,
			'password' => $this->faker->word,
			'email' => $this->faker->word,
			'contact' => $this->faker->word,
			'photo' => $this->faker->word,
			'about' => $this->faker->sentence,
			'education' => $this->faker->sentence,
			'practice' => $this->faker->sentence,
			'residency' => $this->faker->sentence,
			
			

        ];
    }
}
