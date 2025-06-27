<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestasiRequest;
use App\Models\Investasi;
use App\Models\Ternak;
use App\Models\Bank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InvestasiController extends Controller
{

    public function index()
    {
        // $investasi = Investasi::where('id_investor', Auth::id())->get();
        // return view('investasi.index', compact('investasi'));

        $investasi = Investasi::with(['ternak', 'bank'])
            ->where('id_investor', Auth::id())
            ->latest()
            ->paginate(5);

        return view('investasi.index', compact('investasi'));


        // $laporan = LaporanPertumbuhan::with(['petani', 'ternak'])->latest()->paginate(10);

        // return view('petani.laporan', compact('laporan'));
    }
    public function store(InvestasiRequest $request, $ternak_id)
    {
        $investor = Auth::user()->investor;

        if (!$investor) {
            return back()->with('error', 'Akun Anda belum terdaftar sebagai investor.');
        }

        if ($investor->saldo < $request->dana_investasi) {
            return back()->with('error', 'Saldo Anda tidak mencukupi untuk investasi.');
        }

        // Kurangi saldo investor
        $investor->saldo -= $request->dana_investasi;
        $investor->save(); // simpan ke database

        $investasi = Investasi::create([
            'id_investor' => $investor->id, // gunakan ID dari tabel investor
            'id_ternak' => $ternak_id,
            'id_bank' => $request->id_bank,
            'dana_investasi' => $request->dana_investasi,
            'tanggal_investasi' => now(),
            'status' => 'diterima',
        ]);

        return redirect()->route('investor-dashboard')->with('success', 'Investasi berhasil dikirim.');
    }

    public function showForm($id)
    {
        $ternak = Ternak::findOrFail($id);
        $bank = Bank::all();
        return view('investasi.index', compact('ternak', 'bank'));
    }
}
