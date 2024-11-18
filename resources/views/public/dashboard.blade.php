@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="video md:px-20 sm:px-1">
        <div class="judul">
            <h1 class="">COMING SOON</h1>
        </div>
        <div class=" flex space-x-6 overflow-x-auto overflow-y-hidden hide-scrollbar p-6">
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
            <a class="kotak-run" href="">
                <img class="poster-run group" src="{{ asset('img/kuasa-gelap.jpg') }}" alt="">
            </a>
            <a class="kotak-run" href="">
                <img class="poster-run group" src="{{ asset('img/kuasa-gelap.jpg') }}" alt="">
            </a>
        </div>

        <div id="modal" class="modal hidden">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <img src="{{ asset('img/modal-img.jpg') }}" alt="Poster" class="modal-image">
                <h2 class="modal-title">THE SHADOW STRAYS</h2>
                <p class="modal-description">Si pembunuh belia yang terampil menentang mentornya demi menyelamatkan bocah
                    lelaki dari sindikat kejahatan kejam. Ia akan menghancurkan siapa pun yang menghalanginya.</p>
                <button class="start-button">Mulai</button>
            </div>
        </div>

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
            <h1 class="text-white font-semibold mt-3 mb-3 text-center sm:text-left">ALL FILM</h1>
        </div>
        <div class="p-6 grid grid-cols-6 gap-6 grid-flow-row justify-center grid-cols-auto">
            <div class="kotak2">
            </div>
            <div class="kotak2">
            </div>
            <div class="kotak2">
            </div>
            <div class="kotak2">
            </div>
            <div class="kotak2">
            </div>
            <div class="kotak2">
            </div>
            <div class="kotak2">
            </div>
            <div class="kotak2">
            </div>
            <div class="kotak2">
            </div>
        </div>
    </div>
@endsection
