<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_code',
        'table_code',
        'ip_address',
        'mac_address',
        'device_type',
        'os',
        'browser',
        'screen_resolution',
        'status',
    ];

    /**
     * Get the restaurant that owns the MenuRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restraunt::class, 'restaurant_code', 'code');
    }

    /**
     * Get the table that owns the MenuRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function table(): BelongsTo
    {
        return $this->belongsTo(RestrauntTable::class, 'table_code', 'code');
    }
}
