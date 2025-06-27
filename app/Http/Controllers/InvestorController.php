<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use App\Models\Ternak;
use App\Models\LaporanPertumbuhan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function index()
    {
        // Cek role pengguna
        if (Auth::user()->role !== 'investor') {
            return redirect('/');
        }

        $investor = Auth::user()->investor;

        $investasi = $investor->investasi()->with(['ternak', 'bank'])->latest()->paginate(10);

        $user = Auth::user();
        $saldo = $user->investor ? $user->investor->saldo : 0;

        // Ambil ternak dengan relasi petani yang terkait dan eager load petani dan user
        $ternaks = Ternak::with('petani.user')  // Correctly eager load 'petani' and its 'user'
            ->latest()->paginate(10);  // Menggunakan eager loading untuk relasi petani dan user

        // Hitung total laporan
        $laporan = LaporanPertumbuhan::with('petani')->latest()->get();  // Memuat relasi petani untuk laporan
        $total = $laporan->count();
        $totalternak = Ternak::count();
        $jumlahPetani = User::where('role', 'petani')->count();
        $investasi = $investor->investasi()->with(['ternak', 'bank'])->latest()->paginate(10);
        $penarikan = Penarikan::count();


        // Kirim data ke view
        return view('investor.index', compact('ternaks', 'saldo', 'total', 'totalternak', 'jumlahPetani', 'laporan', 'investasi', 'penarikan'));
    }
}
