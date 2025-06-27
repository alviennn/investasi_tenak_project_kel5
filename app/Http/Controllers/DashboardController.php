<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Fungsi untuk mengarahkan ke dashboard berdasarkan tipe pengguna
    public function index()
    {
        $user = Auth::user();

        // Mengarahkan pengguna ke halaman sesuai dengan role mereka
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'investor') {
            return redirect()->route('investor.dashboard');
        } elseif ($user->role == 'petani') {
            return redirect()->route('petani.dashboard');
        }

        return redirect('/'); // Jika role pengguna tidak dikenali
    }

    // Dashboard Admin
    public function admin()
    {
        if (Auth::user()->role != 'admin') {
            return redirect('/');
        }
        return view('admin.index');
    }

    // Dashboard Investor
    public function investor()
    {

        // $query = Investor::query();

        // $saldo = $query->clone()->where('saldo', 'sal')->count();
        $user = Auth::user();
        $saldo = $user->investor ? $user->investor->saldo : 0;  // Memastikan investor ada dan mengambil saldo


        if (Auth::user()->role != 'investor') {
            return redirect('/');
        }
        return view('investor.index', compact('saldo'));
    }

    // Dashboard Petani
    public function petani()
    {

        if (Auth::user()->role != 'petani') {
            return redirect('/');
        }
        return view('petani.index');
    }
}
