<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Actor;
use App\Models\Forum;
use App\Models\Forum_Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(2)->create();

        // User::create([
        //     'name' => 'farhaz nurjananto',
        //     'email' => 'farhaznurjananto052@gmail.com',
        //     'phone' => '081331611696',
        //     'actor_id' => 1,
        //     'password' => bcrypt('12345')
        // ]);

        // User::create([
        //     'name' => 'Farlin Nurjananti',
        //     'email' => 'farlinnurjananti@gmail.com',
        //     'phone' => '081331611698',
        //     'actor_id' => 2,
        //     'password' => bcrypt('12345')
        // ]);

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
    }
}
