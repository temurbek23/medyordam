<?php

namespace Database\Factories;

use App\Models\CallHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CallHistoryFactory extends Factory
{
    protected $model = CallHistory::class;

    public function definition()
    {
        return [
            'doctor_id' => rand(1, 20),
            'patient_id' => rand(1, 20),
            'duration' => rand(1, 30),
        ];
    }
}
