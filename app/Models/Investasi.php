<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Investor;
use App\Models\Ternak;

class Investasi extends Model
{
    use HasFactory;

    protected $table = 'investasi';

    protected $fillable = [
        'id_investor',
        'id_bank',
        'id_ternak',
        'dana_investasi',
        'tanggal_investasi',
        'status',
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    public function ternaks()
    {
        return $this->belongsTo(Ternak::class,'id_ternaks');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }


    // public function komoditas()
    // {
    //     return $this->belongsTo(Komoditas::class);
    // }
}
