<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'restaurant_id', 'category_id', 'grouping_id', 'status', 'frozen', 'allergnes', 'folder', 'filename'
    ];
}