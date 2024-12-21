<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function adminDetail(){
    $movies = Movie::all();
    
    foreach ($movies as $movie) {
        $movie->video_urls = [
            '360p' => str_replace('/upload/', '/upload/w_640,h_360,c_scale/', $movie->video_url),
            '480p' => str_replace('/upload/', '/upload/w_854,h_480,c_scale/', $movie->video_url),
            '720p' => str_replace('/upload/', '/upload/w_1280,h_720,c_scale/', $movie->video_url),
            '1080p' => str_replace('/upload/', '/upload/w_1920,h_1080,c_scale/', $movie->video_url),
        ];
    }

    return view('private.detail', compact('movies'));
    }

    

    public function dashboard()
    {
        $movies = Movie::all();
        foreach ($movies as $movie) {
            $movie->video_urls = [
                '360p' => str_replace('/upload/', '/upload/w_640,h_360,c_scale/', $movie->video_url),
                '480p' => str_replace('/upload/', '/upload/w_854,h_480,c_scale/', $movie->video_url),
                '720p' => str_replace('/upload/', '/upload/w_1280,h_720,c_scale/', $movie->video_url),
                '1080p' => str_replace('/upload/', '/upload/w_1920,h_1080,c_scale/', $movie->video_url),
            ];}

        return view('public.dashboard', compact('movies'));
    }
    
    public function filterByGenre(Request $request)
    {
        $genreName = $request->input('genre');
        
        $movies = Movie::where('genre', $genreName)->get(); 
    
        return view('public.dashboard', compact('movies'));
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
        $movie = Movie::findOrFail($id);
        return view('private.edit', compact('movie'));
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
            $movie = Movie::findOrFail($id);
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
            $movie = Movie::findOrFail($id);
            $movie->delete();

            return redirect()->route('admin.detail')->with('status', 'Film berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}