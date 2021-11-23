<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'restaurant_id', 'category_id', 'grouping_id', 'status', 'frozen', 'allergnes', 'folder', 'filename'
    ];
    /**
     * Get the dishCategory that owns the Dish
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dishCategory(): BelongsTo
    {
        return $this->belongsTo(DishCategory::class, 'grouping_id', 'id');
    }
    /**
     * Get all of the prices for the Dish
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(DishPrice::class, 'dish_id', 'id')->where('category_id','=', 1);
    }
    /**
     * Get the menucategory that owns the Dish
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menuCategory(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'category_id', 'id');
    }
}
