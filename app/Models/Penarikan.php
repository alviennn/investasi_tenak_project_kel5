<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    use HasFactory;

    protected $table = 'penarikan';

    protected $fillable = [
        'id_investor',
        'id_petani',
        'id_bank',
        'nama_bank',
        'nomor_rekening',
        'jumlah_penarikan',
        'tanggal',
        'status',
    ];

    public function petani()
    {
        return $this->belongsTo(Petani::class);
    }

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    
}
