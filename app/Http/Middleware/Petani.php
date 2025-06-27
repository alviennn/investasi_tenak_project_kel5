<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Petani
{
    public function handle(Request $request, Closure $next, $type)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->tipe_pengguna !== $type) {
                return redirect('/'); 
            }

            return $next($request);
        }

        return redirect('login');
    }
}