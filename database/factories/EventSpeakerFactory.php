<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventSpeaker;
use App\Models\Speaker;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventSpeakerFactory extends Factory
{
    protected $model = EventSpeaker::class;

    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'speaker_id' => Speaker::factory(),
        ];
    }
}
