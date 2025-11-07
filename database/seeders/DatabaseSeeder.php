<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        //        Ticket::factory(50)->create();
    }
}
