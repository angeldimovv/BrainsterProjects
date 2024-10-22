<?php

namespace Database\Factories;

use App\Models\Badge;
use App\Models\User;
use App\Models\UserBadge;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserBadgeFactory extends Factory
{
    protected $model = UserBadge::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'badge_id' => Badge::inRandomOrder()->first()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
