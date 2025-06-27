<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenarikanRequest;
use App\Models\Investor;
use App\Models\Petani;
use App\Models\Penarikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class PenarikanController extends Controller
{
    // Fungsi untuk melakukan penarikan dana
    public function penarikanDana(PenarikanRequest $request)
    {
        // Ambil data user yang sedang login
        $user = auth('web')->user();

        $id_investor = null;
        $id_petani = null;
        $saldo = 0;

        // Ambil jumlah yang diminta untuk ditarik
        $jumlahPenarikan = $request->jumlah_penarikan;

        // Tentukan role dan ambil data
        if ($user->role === 'investor') {
            $investor = Investor::where('user_id', $user->id)->first();
            if (!$investor) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data investor tidak ditemukan.',
                ], 404);
            }

            $id_investor = $investor->id;
            $saldo = $investor->saldo;

        } elseif ($user->role === 'petani') {
            $petani = Petani::where('user_id', $user->id)->first();
            if (!$petani) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data petani tidak ditemukan.',
                ], 404);
            }

            $id_petani = $petani->id;
            $saldo = $petani->saldo;

        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Role tidak valid untuk melakukan penarikan.',
            ], 403);
        }

        // Cek apakah saldo cukup
        if ($saldo < $jumlahPenarikan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Saldo tidak mencukupi untuk melakukan penarikan.',
            ], 400);
        }

        // Buat penarikan
        $penarikan = Penarikan::create([
            'id_investor' => $id_investor,
            'id_petani' => $id_petani,
            'id_bank' => $request->id_bank,
            'nama_bank' => $request->nama_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'jumlah_penarikan' => $jumlahPenarikan,
            'tanggal' => now()->toDateString(),
            'status' => 'pending',
        ]);

        // Kurangi saldo setelah penarikan diajukan
        if ($user->role === 'investor') {
            $investor->decrement('saldo', $jumlahPenarikan);
        } elseif ($user->role === 'petani') {
            $petani->decrement('saldo', $jumlahPenarikan);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Penarikan berhasil diajukan',
            'data' => $penarikan,
        ], 201);
    }

    // Fungsi untuk menampilkan riwayat penarikan
    public function penarikan(Request $request)
    {
        // Ambil data user yang sedang login
        $user = auth('web')->user();

        $id_investor = null;
        $id_petani = null;

        // Tentukan role dan ambil ID sesuai dengan role
        if ($user->role === 'investor') {
            $investor = Investor::where('user_id', $user->id)->first();
            if ($investor) {
                $id_investor = $investor->id;
            }
        } elseif ($user->role === 'petani') {
            $petani = Petani::where('user_id', $user->id)->first();
            if ($petani) {
                $id_petani = $petani->id;
            }
        }

        // Ambil riwayat penarikan berdasarkan ID investor atau petani
        $penarikan = Penarikan::where(function ($query) use ($id_investor, $id_petani) {
            if ($id_investor !== null) {
                $query->where('id_investor', $id_investor);
            }
            if ($id_petani !== null) {
                $query->where('id_petani', $id_petani);
            }
        })->get();

        // Kembalikan tampilan penarikan dengan data penarikan
        return view('investor.penarikan', compact('penarikan'));
    }
}