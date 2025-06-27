<?php

namespace App\Http\Requests;

use App\Models\Investasi;
use Illuminate\Foundation\Http\FormRequest;

class InvestasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_bank' => 'required|in:BNI,BRI,BCA',
            'dana_investasi' => 'required|numeric|min:50000',
        ];
    }
}
