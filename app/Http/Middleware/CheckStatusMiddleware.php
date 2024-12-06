<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStatusMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->status === 'Guest') {
            return redirect()->route('dashboard')->with('error', 'Akses tidak diizinkan untuk pengguna Guest.');
        }

        return $next($request);
    }
}