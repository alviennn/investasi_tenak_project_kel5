<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestasiRequest;
use App\Models\Investasi;
use App\Models\Ternak;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InvestasiController extends Controller
{

    public function index()
    {
        // $investasi = Investasi::where('id_investor', Auth::id())->get();
        // return view('investasi.index', compact('investasi'));

        $investasi = Investasi::with('ternak', Auth::id())->latest()->paginate(5);
        return view('investasi.index', compact('ternak'));


        // $laporan = LaporanPertumbuhan::with(['petani', 'ternak'])->latest()->paginate(10);

        // return view('petani.laporan', compact('laporan'));
    }
    public function store(InvestasiRequest $request, $ternak_id)
    {
        $investasi = Investasi::create([
            'id_investor' => Auth::id(),
            'id_bank' => $request->id_bank,
            'id_ternak' => $ternak_id,
            'dana_investasi' => $request->dana_investasi,
            'tanggal_investasi' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('investor-dashboard')->with('success', 'Investasi berhasil dikirim.');
    }

    public function showForm($id)
    {
        $ternak = Ternak::findOrFail($id);
        return view('investasi.form', compact('ternak'));
    }
}
