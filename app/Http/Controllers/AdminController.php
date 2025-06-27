<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Investor;
use App\Models\Investasi;
use App\Models\Ternak;
use App\Models\Bank;

class AdminController extends Controller
{
    public function index()
    {
        $totalInvestor = Investor::count();
        $totalInvestasi = Investasi::sum('dana_investasi');
        $totalTernak = Ternak::count();
        $totalSaldoBank = Bank::sum('saldo');

        $investasiTerbaru = Investasi::with(['investor.user', 'ternaks'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.index', compact(
            'totalInvestor',
            'totalInvestasi',
            'totalTernak',
            'totalSaldoBank',
            'investasiTerbaru'
        ));
    }
}
