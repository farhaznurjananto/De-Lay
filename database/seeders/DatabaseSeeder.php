<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Actor;
use App\Models\Forum;
use App\Models\Forum_Category;
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

        Forum_Category::create([
            'name' => 'Petanian Kedelai'
        ]);
        Forum_Category::create([
            'name' => 'Susu Kedelai'
        ]);

        Forum::create([
            'question' => 'Are you sure you want to play',
            'user_id' => 1,
            'forum_category_id' => 2
        ]);

        Forum::create([
            'question' => 'Are you sure you want to play',
            'user_id' => 2,
            'forum_category_id' => 1
        ]);
    }
}
