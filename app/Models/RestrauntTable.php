<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestrauntTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'restraunt_id',
        'name',
        'code',
    ];

    public function file()
    {
        return $this->morphOne(RestrauntFile::class, 'fileable');
    }
}
