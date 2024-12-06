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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-image: url('{{ asset('img/bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .nav-btn {
            color: white;
            font-weight: bold;
            padding: 0.5rem 1rem;
            transition: background-color 0.3s ease;
        }

        .nav-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .input-field {
            background-color: rgba(19, 78, 74, 0.3);
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            color: white;
        }

        .input-readonly {
            background-color: rgba(10, 36, 34, 0.5);
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            color: white;
            cursor: not-allowed;
        }

        .form-title {
            text-align: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
        }

        .btn-primary {
            background-color: #1D4ED8;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2563EB;
        }

        .btn-outline {
            background-color: transparent;
            color: #1D4ED8;
            border: 2px solid #1D4ED8;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-outline:hover {
            background-color: #1D4ED8;
            color: white;
        }

        .content-container {
            margin-top: 5rem;
            /* Jarak antara navbar dan konten */
        }
    </style>
</head>

<body class="bg-cover bg-center bg-no-repeat bg-fixed flex flex-col min-h-screen">
    <div class="flex-1">
        <!-- Navbar -->
        <nav class="py-4">
            <div
                class="container mx-auto flex items-center justify-between px-6 py-3 bg-teal-900/40 rounded-lg shadow-lg backdrop-blur-lg"">
                <!-- Kembali Button -->
                <a href="{{ url('/') }}" class="text-white font-bold text-2xl">
                    <img class="w-36" src="{{ asset('img/logo.png') }}" alt="Logo">
                </a>

                <!-- Logout and Kembali Navigation -->
                <div class="flex items-center space-x-4">
                    <a href="{{ url('/') }}" class="nav-btn group">
                        Kembali
                    </a>

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
            </div>
        </nav>

        <!-- Content Section -->
        <div class="container mx-auto p-6 py-4 content-container">
            <!-- Profile and Change Password Form -->
            <div class="max-w-full mx-auto bg-teal-900/70 text-white p-6 rounded-lg shadow-lg">
                <h2 class="form-title">Akun Detail dan Ganti Password</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 min-h-[300px]">
                    <!-- User Info Section -->
                    <form method="POST" action="{{ route('profile.updateName') }}" class="space-y-6 flex flex-col">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4 flex-grow">
                            <div>
                                <label for="name" class="block text-white text-sm font-medium mb-2">Nama</label>
                                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                                    class="input-field">
                            </div>

                            <div>
                                <label for="email" class="block text-white text-sm font-medium mb-2">Email</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                                    class="input-readonly" readonly>
                            </div>

                            <div>
                                <label for="type" class="block text-white text-sm font-medium mb-2">Tipe
                                    Akun</label>
                                <input type="text" id="type" name="type"
                                    value="{{ auth()->user()->status }}" class="input-readonly" readonly>
                            </div>
                        </div>

                        <!-- Save Buttons -->
                        <div class="flex justify-between space-x-4 mt-4">
                            <button type="submit" class="btn-primary w-full">Simpan Nama dan Email</button>
                        </div>
                    </form>

                    <!-- Form Password -->
                    <form method="POST" action="{{ route('profile.updatePassword') }}"
                        class="space-y-6 flex flex-col mt-6 md:mt-0">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4 flex-grow">
                            <div>
                                <label for="current_password" class="block text-white text-sm font-medium mb-2">Password
                                    Saat Ini</label>
                                <input type="password" id="current_password" name="current_password" class="input-field"
                                    required>
                            </div>

                            <div>
                                <label for="password" class="block text-white text-sm font-medium mb-2">Password
                                    Baru</label>
                                <input type="password" id="password" name="password" class="input-field" required>
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-white text-sm font-medium mb-2">Konfirmasi Password Baru</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="input-field" required>
                            </div>
                        </div>

                        <!-- Save Buttons -->
                        <div class="flex justify-between space-x-4 mt-4">
                            <button type="submit" class="btn-primary w-full">Simpan Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

<script>
    feather.replace();

    @if (session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @elseif (session('error'))
        Swal.fire({
            title: 'Gagal!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
</script>


</html>
