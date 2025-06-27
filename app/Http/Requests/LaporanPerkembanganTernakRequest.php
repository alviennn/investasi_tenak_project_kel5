<?php

namespace App\Http\Requests;

use App\Models\LaporanPerkembanganTernak;
use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Validation\Rule;

class LaporanPerkembanganTernakRequest extends FormRequest
{ 
    public function authorize(){
        return true;
    }

    public function rules(): array
    {
        return [
            //     'id_petani',
            // 'laporan',
            // 'tanggal_laporan',

            'laporan' => 'require|text',
            'tanggal_laporan' => 'date'
        ];
    }

}