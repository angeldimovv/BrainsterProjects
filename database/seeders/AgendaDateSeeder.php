<?php

namespace Database\Seeders;

use App\Models\AgendaDate;
use Illuminate\Database\Seeder;

class AgendaDateSeeder extends Seeder
{
    public function run(): void
    {
        AgendaDate::factory(10)->create();
    }
}
