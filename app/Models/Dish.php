<?php
// In app/Models/Dish.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import this

class Dish extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
    ];

    /**
     * Get all of the orders for this dish.
     *
     * This defines the inverse relationship.
     * It tells Laravel that one Dish can 'have many' Orders.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}