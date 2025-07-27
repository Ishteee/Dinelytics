<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's create a few sample dishes
        Dish::create(['name' => 'Margherita Pizza', 'price' => 12.99]);
        Dish::create(['name' => 'Classic Burger', 'price' => 9.50]);
        Dish::create(['name' => 'Spaghetti Carbonara', 'price' => 14.75]);
        Dish::create(['name' => 'Caesar Salad', 'price' => 8.99]);
        Dish::create(['name' => 'Chocolate Lava Cake', 'price' => 6.50]);
    }
}
