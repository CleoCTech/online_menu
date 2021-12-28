<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Restraunt extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'name', 'email', 'password', 'code', 'verified', 'email_verified_at', 'token', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function file()
    {
        return $this->morphOne(RestrauntFile::class, 'fileable');
    }
}
