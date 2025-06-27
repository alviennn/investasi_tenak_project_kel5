<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenarikanRequest;
use App\Models\Investor;
use App\Models\Petani;
use App\Models\Penarikan;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class PenarikanController extends Controller
{
    // Fungsi untuk melakukan penarikan dana
    public function penarikanDana(PenarikanRequest $request)
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        $id_investor = null;
        $id_petani = null;
        $saldo = 0;
        $id_bank = null;

        // Ambil jumlah yang diminta untuk ditarik
        $jumlahPenarikan = $request->jumlah_penarikan;

        // Tentukan role dan ambil data
        if ($user->role === 'investor') {
            $investor = Investor::where('user_id', $user->id)->first();

            if (!$investor) {
                return back()->withErrors(['Investor tidak ditemukan.']);
            }

            $id_investor = $investor->id;
            $saldo = $investor->saldo;
            $id_bank = $investor->id_bank; // Ambil dari relasi

        } elseif ($user->role === 'petani') {
            $petani = Petani::where('user_id', $user->id)->first();

            if (!$petani) {
                return back()->withErrors(['Petani tidak ditemukan.']);
            }

            $id_petani = $petani->id;
            $saldo = $petani->saldo;
            $id_bank = $petani->id_bank;
        } else {
            return back()->withErrors(['Role tidak valid.']);
        }

        if ($saldo < $jumlahPenarikan) {
            return back()->withErrors(['Saldo tidak mencukupi untuk penarikan.']);
        }

        $penarikan = Penarikan::create([
            'id_investor' => $id_investor,
            'id_petani' => $id_petani,
            'id_bank' => $id_bank,
            'nama_bank' => $request->nama_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'jumlah_penarikan' => $jumlahPenarikan,
            'tanggal' => now(),
            'status' => 'pending',
        ]);

        if ($user->role === 'investor') {
            $investor->decrement('saldo', $jumlahPenarikan);
        } elseif ($user->role === 'petani') {
            $petani->decrement('saldo', $jumlahPenarikan);
        }

        return redirect()->route('investor-dashboard')->with('success', 'Penarikan berhasil diajukan.');
    }

    // Fungsi untuk menampilkan riwayat penarikan
    // Menampilkan riwayat penarikan
    public function penarikan(Request $request)
    {
        $user = auth::user();

        $id_investor = null;
        $id_petani = null;

        if ($user->role === 'investor') {
            $investor = Investor::where('user_id', $user->id)->first();
            $id_investor = $investor?->id;
        } elseif ($user->role === 'petani') {
            $petani = Petani::where('user_id', $user->id)->first();
            $id_petani = $petani?->id;
        }

        $penarikan = Penarikan::where(function ($query) use ($id_investor, $id_petani) {
            if ($id_investor) $query->where('id_investor', $id_investor);
            if ($id_petani) $query->orWhere('id_petani', $id_petani);
        })->latest()->get();

        $bank = Bank::all();

        return view('investor.penarikan', compact('penarikan', 'bank'));
    }
}
