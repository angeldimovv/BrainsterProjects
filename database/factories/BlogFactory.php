<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'body' => $this->faker->paragraph(5),
            'related_blogs' => $this->faker->randomElements(range(1, 10), $this->faker->numberBetween(0, 4)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::inRandomOrder()->first(),
        ];
    }
}
