<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Investor;

class ProfileController extends Controller
{
    /**
     * Tampilkan form edit profil investor.
     */
    public function edit(Request $request): View
    {
        return view('investor.profile', [
            'user' => $request->user(),
            'investor' => $request->user()->investor,  // Ambil data investor terkait user
        ]);
    }

    /**
     * Update informasi profil investor.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();  // Ambil data user yang sedang login
        $validated = $request->validated();  // Ambil data yang sudah tervalidasi

        // Mulai transaksi database untuk memastikan atomicity
        DB::beginTransaction();

        try {
            // Update data user
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            // Update data investor jika role adalah investor
            if ($user->role === 'investor') {
                // Jika investor sudah ada, update data investor
                $investor = $user->investor;

                // Pastikan data investor ada, jika tidak bisa membuatnya atau update data yang ada
                if ($investor) {
                    $investor->update([
                        'nik' => $validated['nik'],
                        'id_bank' => $validated['id_bank'],
                        'saldo' => $validated['saldo'],
                    ]);
                } else {
                    // Jika data investor belum ada, buat baru
                    Investor::create([
                        'user_id' => $user->id,
                        'nik' => $validated['nik'],
                        'id_bank' => $validated['id_bank'],
                        'saldo' => $validated['saldo'],
                    ]);
                }
            }

            // Commit perubahan ke database
            DB::commit();

            // Redirect ke halaman investor dashboard dengan pesan sukses
            return redirect()->route('investor-dashboard')->with('success', 'Data profil berhasil diperbarui.');
        } catch (\Exception $e) {
            // Jika terjadi error, rollback transaksi
            DB::rollBack();

            // Redirect kembali dengan pesan error
            return redirect()->route('investor-dashboard')->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }

    /**
     * Hapus akun user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
