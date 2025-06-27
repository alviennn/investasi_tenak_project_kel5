<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    /**
     * Relasi antara Komoditas dan Investasi.
     */
    public function investasi()
    {
        return $this->hasMany(Investasi::class, 'id_komoditas');
    }

    /**
     * Relasi antara Komoditas dan Investor melalui Investasi.
     */
    public function investor()
    {
        return $this->belongsToMany(Investor::class, 'investasi', 'id_komoditas', 'id_investor');
    }
}
