@extends('layouts.appadmin')

@section('title', 'Admin-Detail')

@section('content')

    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col lg:ml-64">
        @include('layouts.navbar')
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-8">
                <h3 class="text-gray-700 text-3xl font-bold mb-4">
                    Detail Film
                </h3>
                <p class="text-gray-500 mb-8">
                    Detail film yang sudah ada.
                </p>

                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="bg-white shadow-md rounded-lg p-6 mb-5">
                        <h1 class="font-medium">JUDUL</h1>
                        <h1 class="font-medium">VIDEO</h1>
                        <video class="w-full h-[24rem]" src="{{ asset('img/test.mp4') }}" controls></video>
                        <div class="thumbnail flex">
                            <div class="test w-1/4">
                                <h1 class="font-medium">THUMBNAIL</h1>
                                <img class="w-[19rem] h-[25rem] p-2 shadow-gray-400 shadow-lg rounded-md "
                                    src="{{ asset('img/kuasa-gelap.jpg') }}" alt="">
                            </div>
                            <div class="test w-1/2">
                                <h1 class="font-medium">THUMBNAIL MODAL</h1>
                                <img class="w-[50rem] h-[25rem] p-2 shadow-gray-400 shadow-lg rounded-md "
                                    src="{{ asset('img/kuasa-gelap.jpg') }}" alt="">
                            </div>
                        </div>
                        <h1 class="font-medium">DESKRIPSI</h1>
                        <span>isi deskripsi</span>
                        <h1 class="font-medium">GENRE</h1>
                        <span>isi genre</span>
                        <h1 class="font-medium">release date</h1>
                        <span>isi release date</span>
                    </div>
                </div>
        </main>
    </div>
@endsection
