<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;   // Import the Dish model
use App\Models\Order;  // Import the Order model
use Carbon\Carbon;     // Import Carbon for date manipulation

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all the dishes we created
        $dishes = Dish::all();

        if ($dishes->isEmpty()) {
            $this->command->info('No dishes found. Please run DishSeeder first.');
            return;
        }

        // Let's create 500 random orders over the last year
        for ($i = 0; $i < 500; $i++) {
            // Pick a random dish
            $dish = $dishes->random();
            $quantity = rand(1, 4);

            Order::create([
                'dish_id' => $dish->id,
                'quantity' => $quantity,
                'total_amount' => $dish->price * $quantity,
                // Create a random date within the last year
                'created_at' => Carbon::now()->subDays(rand(0, 365))->subHours(rand(0,23)),
            ]);
        }
    }
}
