<?php

namespace Database\Seeders;

use App\Models\AgendaItem;
use Illuminate\Database\Seeder;

class AgendaItemSeeder extends Seeder
{
    public function run(): void
    {
        AgendaItem::factory(50)->create();
    }
}
