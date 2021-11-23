<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DishPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'dish_id', 'price', 'category_id'
    ];
    /**
     * Get the dish that owns the DishPrice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class, 'dish_id', 'id');
    }
    // public function active_price_category() {
    //     return $this->dish()->price->where('category_id','=', 1);
    // }
    /**
     * Get the priceCategory that owns the DishPrice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priceCategory(): BelongsTo
    {
        return $this->belongsTo(PriceCategory::class, 'category_id', 'id');
    }

}