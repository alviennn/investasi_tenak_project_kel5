<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petani extends Model
{
    use HasFactory;

    protected $table = 'petani';

    protected $fillable = [
        'user_id',
        // 'id_bank',
        // 'saldo',
    ];

    /**
     * Relasi antara Petani dan User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penarikanDana()
    {
        return $this->belongsTo(Penarikan::class);
    }

    public function laporanPerkembanganTernak()
    {
        return $this->hasMany(LaporanPertumbuhan::class, 'id_petani');
    }
}
