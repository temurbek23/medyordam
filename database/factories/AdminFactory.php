<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
			
			'firstname' => $this->faker->word,
			'lastname' => $this->faker->word,
			'password' => $this->faker->word,
			'email' => $this->faker->word,
			
			

        ];
    }
}
