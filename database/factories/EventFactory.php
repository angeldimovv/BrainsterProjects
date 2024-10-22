<?php

namespace Database\Factories;

use App\Models\Agenda;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $agenda = Agenda::inRandomOrder()->first();
        return [
            'title' => $this->faker->word(),
            'theme' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'objective' => $this->faker->paragraph(),
            'date' => $agenda->dates()->first()->date,
            'location' => $this->faker->word(),
            'ticket_price' => $this->faker->randomNumber(),
            'type' => $this->faker->word(),
            'status' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'agenda_id' => $agenda->id,
        ];
    }
}
