<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenarikanRequest extends FormRequest
{
    public function authorize()
    {
        return true;  // Pastikan Anda ingin membolehkan validasi ini
    }

    public function rules()
    {
        return [
            'id_investor' => 'required|exists:investors,id', // Validasi id_investor
            'id_petani' => 'required|exists:petani,id', // Validasi id_petani
            'id_bank' => 'required|exists:bank,id', // Validasi id_bank
            'nama_bank' => 'required|string|max:255', // Nama Bank
            'nomor_rekening' => 'required|string|max:20', // Nomor Rekening
            'jumlah_penarikan' => 'required|numeric|min:1', // Jumlah penarikan harus lebih dari 0
            'tanggal' => 'required|date', // Tanggal penarikan
            'status' => 'required|in:Pending,Success,Failed', // Status penarikan
        ];
    }

    public function messages()
    {
        return [
            'id_investor.required' => 'Investor harus dipilih.',
            'id_petani.required' => 'Petani harus dipilih.',
            'id_bank.required' => 'Bank harus dipilih.',
            'nama_bank.required' => 'Nama bank harus diisi.',
            'nomor_rekening.required' => 'Nomor rekening harus diisi.',
            'jumlah_penarikan.required' => 'Jumlah penarikan harus diisi.',
            'jumlah_penarikan.numeric' => 'Jumlah penarikan harus berupa angka.',
            'jumlah_penarikan.min' => 'Jumlah penarikan minimal adalah 1.',
            'tanggal.required' => 'Tanggal penarikan harus diisi.',
            'status.required' => 'Status penarikan harus dipilih.',
            'status.in' => 'Status penarikan tidak valid.',
        ];
    }
}
