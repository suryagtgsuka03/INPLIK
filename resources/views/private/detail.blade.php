@extends('layouts.appadmin')

@section('title', 'Admin-Detail')

@section('content')
    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col lg:ml-64 bg-gray-50">
        @include('layouts.navbar')

        <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="container mx-auto px-6 py-8">
                <h3 class="text-gray-700 text-3xl font-bold mb-4">Detail Film</h3>
                <p class="text-gray-500 mb-8">Detail film yang tersedia di database Anda.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($movies as $movie)
                        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-xl transform transition duration-300">
                            <h1 class="text-lg font-bold text-gray-800 mb-2">Judul</h1>
                            <p class="text-gray-600">{{ $movie->title }}</p>

                            <h1 class="text-lg font-bold text-gray-800 mt-4">Video</h1>
                            <div>
                                <label for="resolution-{{ $movie->id }}" class="block text-gray-700 font-medium">Pilih
                                    Resolusi</label>
                                <select id="resolution-{{ $movie->id }}"
                                    class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    onchange="changeVideoResolution({{ $movie->id }})">
                                    <option value="{{ $movie->video_urls['360p'] }}">360p</option>
                                    <option value="{{ $movie->video_urls['480p'] }}">480p</option>
                                    <option value="{{ $movie->video_urls['720p'] }}">720p</option>
                                    <option value="{{ $movie->video_urls['1080p'] }}">1080p</option>
                                </select>
                            </div>
                            <video id="videoPlayer-{{ $movie->id }}" class="w-full h-auto rounded-lg mt-2" controls>
                                <source src="{{ $movie->video_urls['360p'] }}" type="video/mp4">
                            </video>

                            <div class="thumbnail grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <h1 class="text-lg font-bold text-gray-800">Thumbnail</h1>
                                    <img class="w-full h-auto rounded-lg shadow-md" src="{{ $movie->thumbnail }}"
                                        alt="Thumbnail">
                                </div>
                                <div>
                                    <h1 class="text-lg font-bold text-gray-800">Thumbnail Modal</h1>
                                    <img class="w-full h-auto rounded-lg shadow-md" src="{{ $movie->thumbnail_modal }}"
                                        alt="Thumbnail Modal">
                                </div>
                            </div>

                            <h1 class="text-lg font-bold text-gray-800 mt-4">Deskripsi</h1>
                            <p class="text-gray-600">{{ $movie->description }}</p>

                            <h1 class="text-lg font-bold text-gray-800 mt-4">Genre</h1>
                            <p class="text-gray-600">{{ $movie->genre }}</p>

                            <h1 class="text-lg font-bold text-gray-800 mt-4">Tanggal Rilis</h1>
                            <p class="text-gray-600">{{ $movie->release_date }}</p>

                            <div class="flex justify-between mt-6 space-x-4">
                                <button type="button"
                                    class="bg-blue-500 text-white px-4 h-[2.5rem] py-2 rounded-lg hover:bg-blue-600 transition duration-300"
                                    onclick="openEditModal({{ $movie }})">
                                    Edit
                                </button>
                                <form id="deleteForm-{{ $movie->id }}" action="{{ route('movie.delete', $movie->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $movie->id }})"
                                        class="bg-red-500 text-white px-4 h-[2.5rem] py-2 rounded-lg hover:bg-red-600 transition duration-300">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>

    <div id="editModal"
        class="fixed z-20 inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-opacity">
        <div class="bg-white shadow-md rounded-lg w-full max-w-xl p-6 relative">
            <h3 class="text-gray-700 text-2xl font-bold mb-4">Edit Film</h3>

            <form id="editForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Judul</label>
                    <input type="text" id="editTitle" name="title"
                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Deskripsi</label>
                    <textarea id="editDescription" name="description" rows="4"
                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Genre</label>
                    <input type="text" id="editGenre" name="genre"
                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Tanggal Rilis</label>
                    <input type="date" id="editReleaseDate" name="release_date"
                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Thumbnail</label>
                    <input type="text" id="editThumbnail" name="thumbnail"
                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Thumbnail Modal</label>
                    <input type="text" id="editThumbnailModal" name="thumbnail_modal"
                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Video URL</label>
                    <input type="text" id="editVideoUrl" name="video_url"
                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button"
                        class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition duration-300"
                        onclick="closeEditModal()">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(movie) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editForm').action = `/admin-edit/${movie.id}`;
            document.getElementById('editTitle').value = movie.title;
            document.getElementById('editDescription').value = movie.description;
            document.getElementById('editGenre').value = movie.genre;
            document.getElementById('editReleaseDate').value = movie.release_date;
            document.getElementById('editThumbnail').value = movie.thumbnail;
            document.getElementById('editThumbnailModal').value = movie.thumbnail_modal;
            document.getElementById('editVideoUrl').value = movie.video_url;
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function confirmDelete(movieId) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + movieId).submit();
                }
            });
        }

        function changeVideoResolution(movieId) {
            const videoPlayer = document.getElementById(`videoPlayer-${movieId}`);
            const resolutionDropdown = document.getElementById(`resolution-${movieId}`);
            videoPlayer.src = resolutionDropdown.value;
            videoPlayer.load();
        }
    </script>
@endsection
