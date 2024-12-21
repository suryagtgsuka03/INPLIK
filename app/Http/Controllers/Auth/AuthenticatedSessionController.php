<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'Admin') {
                return redirect('admin-dashboard')->with('status', 'Login berhasil sebagai admin!');
            }

            return redirect()->intended(route('dashboard'))->with('status', 'Login berhasil!');
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password yang Anda masukkan salah.');
    }
    public function destroy(Request $request)
    {
        Auth::guard(name: 'web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('google_id', $googleUser->getId())
                    ->orWhere('email', $googleUser->getEmail())
                    ->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => null,
                'role' => 'User',
                'status' => 'Guest',
            ]);
        }

        Auth::login($user);
        session()->regenerate();

        return redirect('/');
    }
}