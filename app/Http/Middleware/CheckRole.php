<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::user()->role == $role) {
            return $next($request);
        } else {
            return redirect('/')->withErrors(['error' => 'You do not have the correct role to access this page.']);
        }

        return redirect('/login');
    }
}
