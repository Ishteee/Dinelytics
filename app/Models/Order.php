<?php
// In app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import this

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dish_id',
        'quantity',
        'total_amount',
        'created_at', // Allow mass assignment for seeders
    ];

    /**
     * Get the dish that this order belongs to.
     *
     * This is the function that fixes the error.
     * It tells Laravel that every Order 'belongs to' one Dish.
     */
    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class);
    }
}