<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ternak;
use App\Models\LaporanPertumbuhan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function index()
    {

        // $query = Investor::query();

        // $saldo = $query->clone()->where('saldo', 'sal')->count();
        $user = Auth::user();
        $saldo = $user->investor ? $user->investor->saldo : 0;  // Memastikan investor ada dan mengambil saldo


        if (Auth::user()->role != 'investor') {
            return redirect('/');
        }

        $query = Ternak::query();
        $laporan = LaporanPertumbuhan::query();

        // Ambil data ternak dengan pagination (10 data per halaman)
        $ternaks = $query->latest()->paginate(10);
        $total = $laporan->count();
        $totalternak = $query->count();

        // Kirimkan data ternaks ke view
        return view('investor.index', compact('ternaks', 'saldo', 'total', 'totalternak'));
    }
}
