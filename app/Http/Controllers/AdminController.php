<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Investor;
use App\Models\Investasi;
use App\Models\Ternak;
use App\Models\User;
use App\Models\Bank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index()
    {
        $totalInvestor = Investor::count();
        $totalInvestasi = Investasi::sum('dana_investasi');
        $totalTernak = Ternak::count();
        $totalBank = Bank::count();

        $investasiTerbaru = Investasi::with(['investor.user', 'ternak'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.index', compact(
            'totalInvestor',
            'totalInvestasi',
            'totalTernak',
            'totalBank',
            'investasiTerbaru'
        ));
    }

    public function editProfile()
    {
        $user = Auth::user();

        return view('admin.profile', [
            'user' => $user,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user(); // Pastikan ini adalah instance dari User

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return Redirect::route('admin-dashboard')->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }
}
