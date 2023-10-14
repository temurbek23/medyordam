<?php

namespace Database\Seeders;

use App\Models\CallHistory;
use Illuminate\Database\Seeder;

class CallHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CallHistory::factory()->count(20)->create();
    }
}
