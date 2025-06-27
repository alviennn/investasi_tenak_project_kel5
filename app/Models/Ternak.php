<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ternak extends Model
{
    use HasFactory;

    protected $table = 'ternaks';

    protected $fillable = [
        'id_petani',
        'nama',
        'jenis',
        'status',
        'lokasi',
        'deskripsi',
    ];

    // Relasi ke petani (users table dengan role 'petani')
    // app/Models/Ternak.php

    public function petani()
    {
        return $this->belongsTo(Petani::class);
    }


    public function investasi()
    {
        return $this->belongsTo(Investasi::class, 'id_investasi');
    }
}
