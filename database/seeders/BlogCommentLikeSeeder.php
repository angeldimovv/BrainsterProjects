<?php

namespace Database\Seeders;

use App\Models\BlogCommentLike;
use Illuminate\Database\Seeder;

class BlogCommentLikeSeeder extends Seeder
{
    public function run(): void
    {
        BlogCommentLike::factory(100)->create();
    }
}
