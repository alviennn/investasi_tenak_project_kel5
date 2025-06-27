<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Investor;
use App\Models\User;
use App\Models\Ternak;
// use App\Models\Bank;

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
        return $this->belongsTo(Investor::class, 'id_investor');
    }

    public function ternak()
    {
        return $this->belongsTo(Ternak::class, 'id_ternak');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'id_bank');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }


    // public function komoditas()
    // {
    //     return $this->belongsTo(Komoditas::class);
    // }
}
