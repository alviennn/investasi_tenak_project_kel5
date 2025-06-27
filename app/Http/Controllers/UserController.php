<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\Petani;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan data pengguna.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    /**
     * Menyimpan data pengguna baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,investor,petani'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        if ($user->role === 'petani') {
            Petani::create([
                'id_user' => $user->id,
                'id_bank' => null,
                'saldo' => 0,
            ]);
        }
        if ($user->role === 'investor') {
            Investor::create([
                'id_user' => $user->id,
                'nik' => null,
                'id_bank' => null,
                'saldo' => 0,
            ]);
        }

        // Redirect atau return response
        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
