<?php

namespace Database\Seeders;

use App\Models\UserBadge;
use Illuminate\Database\Seeder;

class UserBadgeSeeder extends Seeder
{
    public function run(): void
    {
        UserBadge::factory(100)->create();
    }
}
