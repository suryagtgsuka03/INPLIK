@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="video md:px-20 sm:px-1">
        <div class="judul">
            <h1 class="">MOVIES</h1>
        </div>

        @if ($movies->count() > 0)
            <div class="flex space-x-6 overflow-x-auto overflow-y-hidden hide-scrollbar p-6">
                @foreach ($movies as $movie)
                    @if (auth()->check() && (auth()->user()->status === 'Premium' || auth()->user()->status === 'Basic'))
                        <a class="kotak-run" href="#" data-id="{{ $movie->id }}">
                            <img class="poster-run group" src="{{ $movie->thumbnail }}" alt="Thumbnail">
                        </a>
                    @else
                        <div class="kotak-run opacity-50 cursor-not-allowed">
                            <img class="poster-run group" src="{{ $movie->thumbnail }}" alt="Thumbnail">
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="flex space-x-6 overflow-x-auto overflow-y-hidden hide-scrollbar p-6">
                <p class="text-white">No movies found for this genre.</p>
            </div>
        @endif

        @foreach ($movies as $movie)
            <div id="modal-{{ $movie->id }}"
                class="modal hidden fixed top-0 left-0 w-full h-full bg-black/70 flex items-center justify-center">
                <div class="modal-content bg-teal-900 w-[40rem] text-center rounded-lg p-5 relative">
                    <span class="close absolute top-2 right-2 text-white text-2xl cursor-pointer"
                        data-id="{{ $movie->id }}">&times;</span>
                    <div>
                        <label for="resolution-{{ $movie->id }}" class="block text-white font-medium">Pilih
                            Resolusi</label>
                        <select id="resolution-{{ $movie->id }}"
                            class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            onchange="changeVideoResolution({{ $movie->id }})">
                            <option value="{{ $movie->video_urls['360p'] }}">360p</option>
                            <option value="{{ $movie->video_urls['480p'] }}">480p</option>
                            <option value="{{ $movie->video_urls['720p'] }}">720p</option>
                            @if (auth()->check() && auth()->user()->status === 'Premium')
                                <option value="{{ $movie->video_urls['1080p'] }}">1080p</option>
                            @else
                                <option value="" class="cursor-not-allowed" disabled>1080p (Premium Only)</option>
                            @endif
                        </select>
                    </div>
                    <video id="videoPlayer-{{ $movie->id }}" class="w-full h-auto rounded-lg mt-2" controls>
                        <source src="{{ $movie->video_urls['360p'] }}" type="video/mp4">
                    </video>
                    <h2 class="modal-title text-xl font-bold mt-4 text-white">{{ $movie->title }}</h2>
                    <p class="modal-description text-gray-300">{{ $movie->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Open modal
        document.querySelectorAll(".kotak-run").forEach(element => {
            element.addEventListener("click", event => {
                event.preventDefault();
                const modal = document.getElementById(`modal-${element.dataset.id}`);
                if (modal) {
                    modal.style.display = "flex";
                }
            });
        });

        document.querySelectorAll(".close").forEach(button => {
            button.addEventListener("click", event => {
                event.preventDefault();
                const movieId = button.dataset.id;
                const modal = document.getElementById(`modal-${movieId}`);
                if (modal) {
                    const video = modal.querySelector("video");
                    // Gunakan kelas untuk menyembunyikan modal
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                    if (video) {
                        video.pause();
                        video.currentTime = 0; // Reset video
                    }
                }
            });
        });

        document.querySelectorAll(".modal").forEach(modal => {
            modal.addEventListener("click", event => {
                if (event.target === modal) {
                    const video = modal.querySelector("video");
                    modal.style.display = "none";
                    if (video) {
                        video.pause();
                        video.currentTime = 0;
                    }
                }
            });
        });
    });
</script>
