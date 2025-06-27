<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPertumbuhan extends Model
{
    protected $table = 'laporan_pertumbuhan';

    protected $fillable = [
        'id_petani',
        // 'id_user',
        'id_ternaks',
        'nama',
        'jenis',
        'tanggal_laporan',
        'berat_rerata',
        'pertumbuhan_persen',
        'status',
    ];

    public function petani()
    {
        return $this->belongsTo(Petani::class,  'id_petani');
    }

    public function ternak()
    {
        return $this->belongsTo(Ternak::class, 'id_ternaks');
    }

    // Relasi ke model User
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
