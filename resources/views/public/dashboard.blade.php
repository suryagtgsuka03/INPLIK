@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="video md:px-20 sm:px-1">
        {{-- <div class="judul">
            <h1 class="">COMING SOON</h1>
        </div>
        <div class="flex space-x-6 overflow-x-auto overflow-y-hidden hide-scrollbar p-6">
            @foreach ($movies as $movie)
                @if (auth()->check() && (auth()->user()->status === 'Premium' || auth()->user()->status === 'Basic'))
                    <a class="kotak-run" href="{{ route('video.dashboard', $movie->id) }}" data-id="{{ $movie->id }}">
                        <img class="poster-run group" src="{{ $movie->thumbnail }}" alt="Thumbnail">
                    </a>
                @else
                    <div class="kotak-run opacity-50 cursor-not-allowed">
                        <img class="poster-run group" src="{{ $movie->thumbnail }}" alt="Thumbnail">
                    </div>
                @endif
            @endforeach
        </div> --}}

        <div class="judul">
            <h1 class="">MOVIES</h1>
        </div>

        @if ($movies->count() > 0)
            <div class="flex space-x-6 overflow-x-auto overflow-y-hidden hide-scrollbar p-6">
                @foreach ($movies as $movie)
                    @if (auth()->check() && (auth()->user()->status === 'Premium' || auth()->user()->status === 'Basic'))
                        <a class="kotak-run" href="{{ route('video.dashboard', $movie->id) }}" data-id="{{ $movie->id }}">
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
            <div id="modal-{{ $movie->id }}" class="modal rounded-md hidden animate__animated animate__fadeIn">
                <div class="modal-content">
                    <span class="close" data-id="{{ $movie->id }}">&times;</span>
                    <img src="{{ $movie->thumbnail_modal }}" alt="Poster" class="modal-image">
                    <div class="container p-5">
                        <h2 class="modal-title">{{ $movie->title }}</h2>
                        <p class="modal-description">{{ $movie->description }}</p>
                        <button class="start-button">Mulai</button>
                    </div>
                </div>
            </div>
        @endforeach


        <div class="judul">
            <h1 class="">MOST WATCH</h1>
        </div>
        <div class="flex space-x-6 overflow-x-auto overflow-y-hidden hide-scrollbar p-6">
            <a class="kotak-run" href="">
                <img class="poster-run group" src="{{ asset('img/kuasa-gelap.jpg') }}" alt="">
            </a>
            <a class="kotak-run" href="">
                <img class="poster-run group" src="{{ asset('img/kuasa-gelap.jpg') }}" alt="">
            </a>
            <a class="kotak-run" href="">
                <img class="poster-run group" src="{{ asset('img/kuasa-gelap.jpg') }}" alt="">
            </a>
            <a class="kotak-run" href="">
                <img class="poster-run group" src="{{ asset('img/kuasa-gelap.jpg') }}" alt="">
            </a>
            <a class="kotak-run" href="">
                <img class="poster-run group" src="{{ asset('img/kuasa-gelap.jpg') }}" alt="">
            </a>
        </div>

        <div class="judul">
            <h1 class="">ALL FILM</h1>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6 p-6">
            @foreach ($movies as $movie)
                <div class="kotak2">
                    <img class="w-full h-auto rounded-md shadow-lg" src="{{ $movie->thumbnail }}" alt="Thumbnail">
                    <h3 class="mt-2 text-center font-medium">{{ $movie->title }}</h3>
                </div>
            @endforeach
        </div>
    </div>
@endsection
