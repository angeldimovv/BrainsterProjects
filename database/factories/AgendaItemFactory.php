<?php

namespace Database\Factories;

use App\Models\Agenda;
use App\Models\AgendaDate;
use App\Models\AgendaItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AgendaItemFactory extends Factory
{
    protected $model = AgendaItem::class;

    public function definition(): array
    {
        return [
            'time' => $this->faker->time(),
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraph(),

            'agenda_id' => Agenda::inRandomOrder()->first()->id,
            'agenda_date_id' => AgendaDate::inRandomOrder()->first()->id,
        ];
    }
}
