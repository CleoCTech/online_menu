<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AllergicFood extends Model
{
    use HasFactory;

    protected $fillable = [
        'dish_id', 'allergene_id'
    ];
    /**
     * Get the allergene that owns the AllergicFood
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function allergene(): BelongsTo
    {
        return $this->belongsTo(Allergene::class, 'allergene_id', 'id');
    }
}
