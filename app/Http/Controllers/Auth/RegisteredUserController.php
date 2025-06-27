<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Investor;
use App\Models\Petani;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:investor,petani'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);


        // Setelah user dibuat, buat data sesuai dengan role
    if ($request->role == 'investor') {
        // Simpan data ke tabel investor
        Investor::create([
            'user_id' => $user->id,
        ]);
    } elseif ($request->role == 'petani') {
        // Simpan data ke tabel petani
        Petani::create([
            'user_id' => $user->id,
        ]);
    }

    event(new Registered($user));

    // Uncomment jika ingin langsung login
    // Auth::login($user);

    session()->flash('success', 'Registrasi berhasil! Silakan login.');


    return redirect(route('login', absolute: false));


        // event(new Registered($user));

        // // Auth::login($user);

        // return redirect(route('login', absolute: false));
    }
}
