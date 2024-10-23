<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => '',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
        ]);
        User::factory(100)->create();
    }
}
