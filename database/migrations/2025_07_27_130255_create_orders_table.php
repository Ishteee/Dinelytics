<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Link to the 'dishes' table
            $table->foreignId('dish_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            // We store the total amount for the order to make calculations easier later
            $table->decimal('total_amount', 8, 2);
            // The 'created_at' timestamp will serve as our order time
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
