<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestrauntFile extends Model
{
    use HasFactory;

    protected $fillable =[
        'restraunt_id',
        'folder',
        'filename',
        'fileable_id',
        'fileable_type'
    ];

    /**
     * Get the restraunt that owns the RestrauntFile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restraunt(): BelongsTo
    {
        return $this->belongsTo(Restraunt::class, 'restraunt_id', 'id');
    }

    public function fileable()
    {
        return $this->morphTo();
    }
}
