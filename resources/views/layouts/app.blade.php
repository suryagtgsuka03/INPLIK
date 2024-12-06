<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Halaman')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: rgb(19 78 74);
            width: 40rem;
            text-align: center;
            border-radius: 8px;
            color: white;
            position: relative;
        }

        .close {
            position: absolute;
            top: -0.5rem;
            right: 10px;
            color: white;
            font-size: 35px;
            cursor: pointer;
        }

        .modal-image {
            width: 100%;
            height: 20rem;
            border-radius: 0 0 5rem 5rem;
        }

        .start-button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>

<body class="bg-cover bg-center bg-no-repeat bg-fixed flex flex-col min-h-screen"
    style="background-image: url('{{ asset('img/bg.jpg') }}')">
    <div class="flex-1">
        <nav class="py-4">
            <div
                class="container mx-auto flex items-center justify-between px-6 py-3 bg-teal-900/40 rounded-lg shadow-lg backdrop-blur-lg">
                <a href="/" class="text-white font-bold text-2xl">
                    <img class="w-36" src="{{ asset('img/logo.png') }}" alt="Logo">
                </a>

                <div class="flex-1 flex justify-center gap-10 text-white font-semibold space-x-6 sm:space-x-10">
                    <a href="/" class="nav-btn group">Beranda</a>
                    <div x-data="genreDropdown()" class="relative inline-block text-left">
                        <a @click="open = !open" class="nav-btn group cursor-pointer flex items-center space-x-1">
                            Kategori
                        </a>
                        <div x-show="open" @click.away="open = false"
                            class="absolute z-10 mt-2 bg-white rounded-lg shadow-lg w-64 p-4 left-1/2 -translate-x-1/2">
                            <div class="grid grid-cols-2 gap-2">
                                <template x-for="genre in genres" :key="genre.name">
                                    <a :href="`/movies?genre=${genre.name}`"
                                        class="block text-gray-700 hover:text-white hover:bg-teal-500 rounded-lg px-2 py-1 text-sm">
                                        <span x-text="genre.name"></span>
                                    </a>
                                </template>
                            </div>
                        </div>
                    </div>
                    {{-- <div x-data="genreDropdown()" class="relative inline-block text-left">
                        <!-- Button -->
                        <a @click="open = !open" class="nav-btn group cursor-pointer flex items-center space-x-1">
                            Kategori
                        </a>
                        <div x-show="open" @click.away="open = false"
                            class="absolute z-10 mt-2 bg-white rounded-lg shadow-lg w-64 p-4 left-1/2 -translate-x-1/2">
                            <div class="grid grid-cols-2 gap-2">
                                <!-- Genre Items -->
                                <template x-for="genre in genres" :key="genre.id">
                                    <a :href="`/movies?genre=${genre.name}`"
                                        class="block text-gray-700 hover:text-white hover:bg-teal-500 rounded-lg px-2 py-1 text-sm">
                                        <span x-text="genre.name"></span>
                                    </a>
                                </template>
                            </div>
                        </div>
                    </div> --}}
                    <a href="/berlangganan" class="nav-btn group">Berlangganan</a>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="relative group">
                        <!-- Ikon dengan Feather -->
                        <i class="text-white text-2xl hover:text-yellow-400 transition-colors duration-300"
                            data-feather="{{ Auth::user()->status === 'Premium' ? 'anchor' : (Auth::user()->status === 'Basic' ? 'bold' : (Auth::user()->status === 'Guest' ? 'user' : 'help-circle')) }}">
                        </i>
                        <!-- Tooltip -->
                        <div
                            class="absolute left-1/2 transform -translate-x-1/2 mt-2 bg-gray-800 text-white text-sm rounded px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 shadow-md whitespace-nowrap pointer-events-none">
                            Status: {{ Auth::user()->status ?? 'Tidak Diketahui' }}
                        </div>
                    </div>


                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="inline-flex items-center px-3 py-2 border text-sm rounded-md text-gray-500 bg-white hover:text-gray-700">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log
                                        Out</button>
                                </form>
                                <a href="{{ url('/account-detail') }}"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Akun Detail
                                </a>
                            </div>
                        </div>
                    @else
                        <a href="/login"
                            class="p-2 w-24 text-center text-white font-semibold bg-teal-400 rounded-full hover:bg-teal-500">
                            Login
                        </a>
                    @endauth
                </div>

                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = !open"
                        class="p-2 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path x-show="!open" stroke="currentColor" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke="currentColor" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="content mt-6 mx-10">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-teal-900/70 text-white py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div>
                    <h4 class="font-bold text-xl mb-4">Tentang Kami</h4>
                    <p>NETFLIX VERSI BAJAKAN.</p>
                </div>
                <div>
                    <h4 class="font-bold text-xl mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="hover:text-teal-300">Beranda</a></li>
                        <li><a href="/kategori" class="hover:text-teal-300">Kategori</a></li>
                        <li><a href="/berlangganan" class="hover:text-teal-300">Berlangganan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-xl mb-4">Kontak</h4>
                    <p>Email: suryahaganta03@gmail.com</p>
                    <p>Telepon: +62 821 6777 9792</p>
                </div>
            </div>
            <div class="mt-8 text-center border-t border-teal-700 pt-4">
                <p>&copy; {{ date('Y') }} INPLIK. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</body>

<script>
    feather.replace();

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".kotak-run").forEach(element => {
            element.addEventListener("click", event => {
                event.preventDefault();
                document.getElementById(`modal-${element.dataset.id}`).style.display = "flex";
            });
        });

        document.querySelectorAll(".close").forEach(button => {
            button.addEventListener("click", event => {
                event.preventDefault();
                document.getElementById(`modal-${button.dataset.id}`).style.display = "none";
            });
        });

        document.querySelectorAll(".modal").forEach(modal => {
            modal.addEventListener("click", event => {
                if (event.target === modal) modal.style.display = "none";
            });
        });
    });

    function genreDropdown() {
        return {
            open: false,
            genres: [{
                    name: "Action"
                },
                {
                    name: "Adventure"
                },
                {
                    name: "Comedy"
                },
                {
                    name: "Drama"
                },
                {
                    name: "Horror"
                },
                {
                    name: "Romance"
                },
                {
                    name: "Sci-Fi"
                },
                {
                    name: "Thriller"
                },
                {
                    name: "Fantasy"
                },
                {
                    name: "Mystery"
                },
            ],
        };
    }
</script>

</html>
