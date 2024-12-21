<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    public function edit()
    {
        return view('private.akundetail');
    }
    
    public function updateName(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);
    
            auth()->user()->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            return redirect()->back()->with('success', 'Nama berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui Nama.');
        }
    }
    public function updatePassword(Request $request)
    {
        try {
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
    
            return redirect()->back()->with('success', 'Password berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui password.');
        }
    }
    
}