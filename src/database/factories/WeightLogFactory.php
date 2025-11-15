<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\WeightLog;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = WeightLog::class;

    public function definition()
    {

        $user = User::first();

        return [
            'user_id' => $user->id,
            'date' => $this->faker->date,
            'weight' => $this->faker->randomFloat(1, 40, 150),
            'calories' => $this->faker->numberBetween(0,1000),
            'exercise_time' => $this->faker->time,
            'exercise_content' => $this->faker->text(120),
        ];
    }
}
