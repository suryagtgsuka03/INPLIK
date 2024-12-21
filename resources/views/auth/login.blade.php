@extends('auth.app')

@section('title', 'Login')

@section('content')
    <div
        class="w-[29rem] h-[29rem] bg-teal-900/30 backdrop-blur-sm rounded-lg shadow-xl shadow-teal-900 p-3 justify-items-center">
        <h1 class="text-white font-bold text-3xl mt-5 mb-7">LOGIN</h1>

        {{-- Tampilkan pesan sukses login --}}
        @if (session('status'))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('status') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
        {{-- Tampilkan pesan error login --}}
        @if (session('error'))
            <script>
                Swal.fire({
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi'
                });
            </script>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="email mb-[2rem]">
                <i data-feather="mail" class="icon-form"></i>
                <input class="form" name="email" type="email" placeholder="Enter your email" value="{{ old('email') }}">
            </div>

            <div class="password mb-[3rem]">
                <i data-feather="lock" class="icon-form"></i>
                <input class="form" name="password" type="password" placeholder="Enter your password">
            </div>

            <div class="flex items-center justify-center mt-4 mb-12">
                <a href="{{ route('redirectToGoogle') }}"
                    class="flex items-center gap-3 bg-white text-gray-600 border border-gray-300 rounded-lg shadow-md hover:shadow-lg hover:bg-gray-100 px-6 py-2 transition">
                    <img src="{{ asset('img/google.png') }}" alt="Google logo" class="w-6 h-6">
                    <span class="font-medium">Sign in with Google</span>
                </a>
            </div>

            <div class="btn-con">
                <a href="{{ route('register') }}" class="btn">Register</a>
                <button type="submit" class="btn">Login</button>
            </div>
        </form>
    </div>
@endsection
