<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

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
