<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Ternak;

class TernakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|in:ayam, sapi, ambing, bebek, ikan',
            'jumlah' => 'required|integer|min:1',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|string|in:active, inactive, pending',
        ];

    }
}
