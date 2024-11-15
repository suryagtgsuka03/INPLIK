<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title', 'Halaman')</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        /* Modal styles */
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
            top: -.5rem;
            right: 10px;
            color: white;
            font-size: 35px;
            cursor: pointer;
        }

        .modal-image {
            width: 100%;
            height: 20rem;
            border-radius: 0rem 0rem 5rem 5rem;
            box-shadow: ;
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

<body class="bg-cover bg-center bg-no-repeat bg-fixed" style="background-image: url('{{ asset('img/bg.jpg') }}')">
    <nav class="py-4">
        <div
            class="container mx-auto flex items-center justify-between px-6 py-3 bg-teal-900/40 rounded-lg shadow-lg backdrop-blur-lg">
            <!-- Logo -->
            <a href="/" class="text-white font-bold text-2xl">
                <img class="w-36" src="{{ asset('img/logo.png') }}" alt="Logo">
            </a>

            <!-- Centered Links -->
            <div class="flex-1 flex justify-center gap-10 text-white font-semibold space-x-6 sm:space-x-10">
                <a href="/beranda" class="nav-btn group">
                    Beranda
                    <span class="nav-btn-hover"></span>
                </a>
                <a href="/kategori" class="nav-btn group">
                    Kategori
                    <span class="nav-btn-hover"></span>
                </a>
                <a href="/langganan" class="nav-btn group">
                    Berlangganan
                    <span class="nav-btn-hover"></span>
                </a>
            </div>

            <!-- Right Side (Search and Auth Links) -->
            <div class="flex items-center space-x-4">
                <!-- Search Form -->
                <form action="/search" method="GET" class="relative hidden sm:flex sm:items-center">
                    <input class="form-input search h-10 pl-3 pr-10 rounded-lg text-sm" type="text" name="search"
                        id="search" placeholder="Search film" />
                    <button>
                        <i class="icon-search" data-feather="search"></i>
                    </button>
                </form>

                <!-- Auth Links -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = ! open"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                            <div x-show="open" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2">
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log
                                        Out</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="/login"
                            class="p-2 w-24 text-center text-white font-semibold bg-teal-400 rounded-full shadow-md transition-transform duration-300 hover:scale-105 hover:bg-teal-500">
                            Login
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Hamburger Menu for Small Screens -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition:enter="transition transform duration-300 ease-out"
        x-transition:leave="transition transform duration-300 ease-in" class="sm:hidden bg-teal-900/40 rounded-lg mt-4">
        <a href="/beranda" class="block px-4 py-2 text-white font-semibold">Beranda</a>
        <a href="/kategori" class="block px-4 py-2 text-white font-semibold">Kategori</a>
        <a href="/langganan" class="block px-4 py-2 text-white font-semibold">Berlangganan</a>
        @auth
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-white font-semibold">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-white font-semibold">Log Out</button>
            </form>
        @else
            <a href="/login" class="block px-4 py-2 text-white font-semibold">Login</a>
        @endauth
    </div>

    <div class="content mt-6 mx-10 ">
        @yield('content')
    </div>

    <footer class="bg-teal-900/70 text-white py-10 mt-auto">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div>
                    <h4 class="font-bold text-xl mb-4">Tentang Kami</h4>
                    <p>Deskripsi singkat tentang website Anda.</p>
                </div>
                <div>
                    <h4 class="font-bold text-xl mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="/beranda" class="hover:text-teal-300">Beranda</a></li>
                        <li><a href="/kategori" class="hover:text-teal-300">Kategori</a></li>
                        <li><a href="/langganan" class="hover:text-teal-300">Berlangganan</a></li>
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
    // buka modal
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("modal");
        const closeModal = document.getElementById("closeModal");
        const kotakRunElements = document.querySelectorAll(".kotak-run");

        // Function to open the modal
        function openModal() {
            console.log("Opening modal...");
            modal.style.display = "flex";
        }

        // Function to close the modal
        function closeModalFunction() {
            console.log("Closing modal...");
            modal.style.display = "none";
        }

        // Add click event listeners to each .kotak-run element
        kotakRunElements.forEach(function(element) {
            element.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default action if it's a link
                openModal();
            });
        });

        // Add event listener to close button
        closeModal.addEventListener("click", function(event) {
            event.preventDefault();
            closeModalFunction();
        });

        // Close modal if clicking outside of the modal content
        modal.addEventListener("click", function(event) {
            if (event.target === modal) {
                closeModalFunction();
            }
        });
    });
    // tutup modal
</script>

</html>
