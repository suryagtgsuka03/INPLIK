@extends('layouts.appadmin')

@section('title', 'Admin-Input')

@section('content')

    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col lg:ml-64">
        @include('layouts.navbar')
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-8">
                <h3 class="text-gray-700 text-3xl font-bold mb-4">
                    Input Film
                </h3>
                <p class="text-gray-500 mb-8">
                    Lengkapi form berikut untuk menambahkan data film baru.
                </p>

                <div class="bg-white shadow-md rounded-lg p-6">
                    <form action="{{ route('movie.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" id="title" name="title" required
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3"
                                placeholder="Masukkan judul film">
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" required rows="4"
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3"
                                placeholder="Masukkan deskripsi film"></textarea>
                        </div>
                        <div>
                            <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
                            <input type="text" id="genre" name="genre" required
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3"
                                placeholder="Masukkan genre film">
                        </div>
                        <div>
                            <label for="release_date" class="block text-sm font-medium text-gray-700">Release Date</label>
                            <input type="date" id="release_date" name="release_date" required
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3">
                        </div>
                        <div>
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail (URL)</label>
                            <input type="url" id="thumbnail" name="thumbnail" required
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3"
                                placeholder="Masukkan URL thumbnail">
                        </div>
                        <div>
                            <label for="thumbnail_modal" class="block text-sm font-medium text-gray-700">Thumbnail Modal
                                (URL)</label>
                            <input type="url" id="thumbnail_modal" name="thumbnail_modal" required
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3"
                                placeholder="Masukkan URL thumbnail modal">
                        </div>
                        <div>
                            <label for="video_url" class="block text-sm font-medium text-gray-700">Video URL</label>
                            <input type="url" id="video_url" name="video_url" required
                                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3"
                                placeholder="Masukkan URL video">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-8 py-3 bg-blue-600 text-white font-medium text-sm rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection
