<?php

namespace Database\Seeders;

use App\Models\EventSpeaker;
use Illuminate\Database\Seeder;

class EventSpeakerSeeder extends Seeder
{
    public function run(): void
    {
        EventSpeaker::factory(100)->create();
    }
}
