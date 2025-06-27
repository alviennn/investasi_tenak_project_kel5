<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanPertumbuhanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:Sapi,Domba,Kambing,Ayam,Bebek,Ikan',
            'tanggal_laporan' => 'required|date',
            'berat_rerata' => 'required|string|max:50',
            'pertumbuhan_persen' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:Excellent,Good,Average,Poor',
        ];
    }
}
