<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PriceCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'restaurant_id', 'status'
    ];
    /**
     * Get all of the dishPrices for the PriceCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pricesdishPrices(): HasMany
    {
        return $this->hasMany(DishPrice::class, 'category_id', 'id');
    }
}