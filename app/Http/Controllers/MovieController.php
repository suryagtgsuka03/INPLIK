<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function adminDetail()
    {
        $movies = Movie::all(); // Mengambil semua data film dari database
        return view('private.detail', compact('movies',)); // Mengirimkan data ke view
    }

    public function dashboard()
    {
        $movies = Movie::all(); // Mengambil semua data film dari database
        return view('public.dashboard', compact('movies')); // Mengirimkan data ke view
    }
    
    public function filterByGenre(Request $request)
    {
        $genreName = $request->input('genre');
        
        // Fetch movies by genre name
        $movies = Movie::where('genre', $genreName)->get(); 
    
        return view('public.dashboard', compact('movies')); // Return the view with filtered movies
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'genre' => 'required|string|max:100',
            'release_date' => 'required|date',
            'thumbnail' => 'required|url|max:500',
            'thumbnail_modal' => 'required|url|max:500',
            'video_url' => 'required|url|max:500',
        ]);

        try {
            Movie::create([
                'title' => $request->title,
                'description' => $request->description,
                'genre' => $request->genre,
                'release_date' => $request->release_date,
                'thumbnail' => $request->thumbnail,
                'thumbnail_modal' => $request->thumbnail_modal,
                'video_url' => $request->video_url,
            ]);

            return redirect()->back()->with('status', 'Film berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        $movie = Movie::findOrFail($id); // Cari film berdasarkan ID
        return view('private.edit', compact('movie')); // Tampilkan view untuk edit film
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'genre' => 'required|string|max:100',
            'release_date' => 'required|date',
            'thumbnail' => 'required|url|max:500',
            'thumbnail_modal' => 'required|url|max:500',
            'video_url' => 'required|url|max:500',
        ]);

        try {
            $movie = Movie::findOrFail($id); // Cari film berdasarkan ID
            $movie->update([
                'title' => $request->title,
                'description' => $request->description,
                'genre' => $request->genre,
                'release_date' => $request->release_date,
                'thumbnail' => $request->thumbnail,
                'thumbnail_modal' => $request->thumbnail_modal,
                'video_url' => $request->video_url,
            ]);

            return redirect()->route('admin.detail')->with('status', 'Film berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $movie = Movie::findOrFail($id); // Cari film berdasarkan ID
            $movie->delete(); // Hapus data film

            return redirect()->route('admin.detail')->with('status', 'Film berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}