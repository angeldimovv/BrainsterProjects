<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\CompanyInfo;
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
            RecommendationSeeder::class,
            ConnectionSeeder::class,
            BadgeSeeder::class,
            UserBadgeSeeder::class,
            BlogSeeder::class,
            BlogCommentSeeder::class,
            BlogCommentLikeSeeder::class,
            AgendaSeeder::class,
            AgendaDateSeeder::class,
            AgendaItemSeeder::class,
            EventSeeder::class,
            SpeakerSeeder::class,
            EventSpeakerSeeder::class,
            CompanyInfo::class,
        ]);
    }
}
