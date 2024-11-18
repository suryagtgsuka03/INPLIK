<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function movie()
    {
        return view('private.admin');
    }

    public function store(Request $request)
    {
        // Lakukan validasi
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'genre' => ['required', 'string', 'max:100'],
            'release_date' => ['required', 'date'],
            'thumbnail' => ['required', 'string', 'max:100'],
            'thumbnail_modal' => ['required', 'string', 'max:100'],
            'video_url' => ['required', 'string', 'max:100'],
        ]);

        try {
            // Menyimpan data film ke dalam database
            Movie::create([
                'title' => $request->title,
                'description' => $request->description,
                'genre' => $request->genre,
                'release_date' => $request->release_date,
                'thumbnail' => $request->thumbnail,
                'thumbnail_modal' => $request->thumbnail_modal,
                'video_url' => $request->video_url,
            ]);

            return redirect()->back()->with('status', 'Data Berhasil Disimpan');
        } catch (\Exception $e) {
            // Menangani exception jika ada kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
