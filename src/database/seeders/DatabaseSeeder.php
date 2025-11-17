<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'password' =>Hash::make('password'),
        ]);

        WeightTarget::factory()->create([
            'user_id' => $user->id,
            'target_weight' => 50,
        ]);

        WeightLog::factory(35)->create([
            'user_id' => $user->id,
        ]);
    }
}
