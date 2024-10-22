<?php

namespace Database\Factories;

use App\Models\BlogComment;
use App\Models\BlogCommentLike;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BlogCommentLikeFactory extends Factory
{
    protected $model = BlogCommentLike::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'blog_comment_id' => BlogComment::inRandomOrder()->first(),
            'user_id' => User::inRandomOrder()->first(),
        ];
    }
}
