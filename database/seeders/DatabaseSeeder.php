<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Actor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(2)->create();

        Actor::create([
            'name' => 'Petani Kedelai',
        ]);
        Actor::create([
            'name' => 'Produsen Susu Kedelai',
        ]);
    }
}
