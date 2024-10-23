<?php

namespace Database\Seeders;

use App\Models\BlogComment;
use Illuminate\Database\Seeder;

class BlogCommentSeeder extends Seeder
{
    public function run(): void
    {
        BlogComment::factory(150)->create();
    }
}
