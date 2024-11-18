<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Coba untuk mengautentikasi pengguna
        if (Auth::attempt($request->only('email', 'password'))) {
            // Jika berhasil, regenerasi session
            $request->session()->regenerate();

            $user = Auth::user();

            // Arahkan berdasarkan peran pengguna
            if ($user->role === 'Admin') {
                return redirect('admin-dashboard')->with('status', 'Login berhasil sebagai admin!');
            }

            return redirect()->intended(route('dashboard'))->with('status', 'Login berhasil!');
        }

        // Jika autentikasi gagal, tambahkan pesan notifikasi
        return redirect()->back()
            ->withInput($request->only('email')) // Mengingat input email
            ->with('error', 'Email atau password yang Anda masukkan salah.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
