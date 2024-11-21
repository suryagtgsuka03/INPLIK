<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function actionregister(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255',
            'password' => 'required|min:2',
        ]);

        User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('status', 'Registrasi Berhasil');
    }
}