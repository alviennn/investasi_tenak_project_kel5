<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Investor extends Model
{
    use HasFactory;

    protected $table = 'investor';

    protected $fillable = [
        'user_id',
        'nik',
        'id_bank',
        'saldo',
    ];

    /**
     * Relasi antara Investor dan User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penarikanDana()
    {
        return $this->belongsTo(Penarikan::class);
    }

    

    /**
     * Relasi antara Investor dan Komoditas melalui Investasi.
     */
    public function komoditas()
    {
        return $this->belongsToMany(Komoditas::class, 'investasi', 'id_investor', 'id_komoditas');
    }

    /**
     * Relasi antara Investor dan Investasi.
     */
    public function investasi()
    {
        return $this->hasMany(Investasi::class, 'id_investor');
    }
}
