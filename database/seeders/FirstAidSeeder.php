<?php

namespace Database\Seeders;

use App\Models\FirstAid;
use Illuminate\Database\Seeder;

class FirstAidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\FirstAid::factory()->count(20)->create();
    }
}
