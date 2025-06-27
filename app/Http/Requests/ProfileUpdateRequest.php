<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'nik' => 'required|string|max:255',  // Perbaiki aturan validasi nik
            'id_bank' => 'required|exists:bank,id',  // Memastikan id_bank ada di tabel bank
            'saldo' => 'required|numeric|min:10000',  // Memastikan saldo lebih dari 10000
            'name' => 'required|string|max:255',  // Validasi name
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),  // Validasi email unik, kecuali milik pengguna yang sedang login
            ],
        ];
    }
}
