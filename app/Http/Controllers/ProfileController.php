<?php

// ProfileController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    // Menampilkan halaman edit profil
    public function edit()
    {
        return view('private.akundetail');
    }

    // Update nama dan email
    public function updateName(Request $request)
    {
        try {
            // Proses update nama dan email
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);
    
            auth()->user()->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
    
            // Setelah berhasil update, set session untuk sukses
            return redirect()->back()->with('success', 'Nama berhasil diperbarui!');
        } catch (\Exception $e) {
            // Jika gagal, set session untuk error
            return redirect()->back()->with('error', 'Gagal memperbarui Nama.');
        }
    }
    
    public function updatePassword(Request $request)
    {
        try {
            // Proses update password
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ]);
    
            $user = auth()->user();
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'Password saat ini tidak sesuai.');
            }
    
            $user->update([
                'password' => Hash::make($request->password),
            ]);
    
            // Setelah berhasil update password
            return redirect()->back()->with('success', 'Password berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui password.');
        }
    }
    
}