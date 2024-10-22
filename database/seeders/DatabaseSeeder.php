<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ActivityLogSeeder::class,
            BadgeSeeder::class,
            UserBadgeSeeder::class,
            BlogSeeder::class,
            BlogCommentSeeder::class,
            BlogCommentLikeSeeder::class,
        ]);
    }
}
