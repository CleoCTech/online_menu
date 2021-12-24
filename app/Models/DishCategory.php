<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DishCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'restaurant_id', 'status'
    ];
    /**
     * Get all of the dishes for the DishCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class, 'grouping_id', 'id');
    }
}
