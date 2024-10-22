<?php

namespace Database\Factories;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ActivityLogFactory extends Factory
{
    protected $model = ActivityLog::class;

    public function definition(): array
    {
        return [
            'notification_preference' => [
                'target' => $this->faker->words,
                'topic' => $this->faker->words,
            ],
            'points' => $this->faker->numberBetween(0, 500),
            'bought_tickets' => $this->faker->randomElements(range(1, 50), $this->faker->numberBetween(0, 10)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
        ];
    }
}
