<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightLog;

class WeightLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::all()->each(function ($user) {
            WeightLog::factory()->count(35)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
