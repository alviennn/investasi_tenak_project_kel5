<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Relasi ke tabel investor
     */
    public function investor(): HasOne
    {
        return $this->hasOne(Investor::class);
    }

    /**
     * Relasi ke tabel petani
     */
    public function petani(): HasOne
    {
        return $this->hasOne(Petani::class);
    }

    public function laporan()
    {
        return $this->hasMany(LaporanPertumbuhan::class);
    }
}
