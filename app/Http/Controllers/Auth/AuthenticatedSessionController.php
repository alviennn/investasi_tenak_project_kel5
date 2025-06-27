<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // Cek role pengguna dan arahkan ke halaman sesuai role
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin-dashboard');
            } elseif (Auth::user()->role == 'investor') {
                return redirect()->route('investor-dashboard');
            } elseif (Auth::user()->role == 'petani') {
                return redirect()->route('petani-dashboard');
            }
        }
        

        // Jika gagal login
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Log the user out of the application.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role == 'admin') {
            return redirect()->route('admin-dashboard');
        } elseif ($user->role == 'investor') {
            return redirect()->route('investor-dashboard');
        } elseif ($user->role == 'petani') {
            return redirect()->route('petani-dashboard');
        }

        // Redirect default jika role tidak cocok
        return redirect('/');
    }

    public function create()
    {
        return view('auth.login'); 
    }
}
