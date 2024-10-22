<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BlogCommentFactory extends Factory
{
    protected $model = BlogComment::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->paragraph(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'blog_id' => Blog::inRandomOrder()->firstOrFail()->id,
            'user_id' => User::inRandomOrder()->firstOrFail()->id,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (BlogComment $blogComment) {
            if($this->faker->boolean(50)) {
                $repliedToComment = BlogComment::where('blog_id', $blogComment->blog_id)->inRandomOrder()->firstOrFail();
                $blogComment->repliedTo()->associate($repliedToComment);
                $blogComment->save();
            }
        });
    }
}
