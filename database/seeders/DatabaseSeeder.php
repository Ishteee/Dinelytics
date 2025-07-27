<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // We must run DishSeeder first so that the orders have dishes to link to.
        $this->call([
            DishSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
