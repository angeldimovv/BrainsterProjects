<?php

namespace Database\Factories;

use App\Models\Agenda;
use App\Models\AgendaDate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AgendaDateFactory extends Factory
{
    protected $model = AgendaDate::class;

    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTimeThisYear('+1 year')->format('Y-m-d'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'agenda_id' => Agenda::factory(),
        ];
    }
}