@extends('auth.app')

@section('title', 'Register')

@section('content')
    <div
        class="w-[29rem] h-[29rem] bg-teal-900/30 backdrop-blur-sm rounded-lg shadow-xl shadow-teal-900 p-3 justify-items-center">
        <h1 class="text-white font-bold text-3xl mt-5 mb-7">REGISTER</h1>
        @if (session('status'))
            <script>
                Swal.fire({
                    title: 'Registrasi Berhasil!',
                    text: '{{ session('status') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        {{-- Tampilkan pesan error jika ada kesalahan validasi --}}
        @if ($errors->any())
            <script>
                Swal.fire({
                    title: 'Registrasi Gagal!',
                    html: '<ul>' +
                        @foreach ($errors->all() as $error)
                            '<li>{{ $error }}</li>' +
                        @endforeach
                    '</ul>',
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi'
                });
            </script>
        @endif
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="email mb-[1rem]">
                <i data-feather="mail" class="icon-form"></i>
                <input class="form" id="email" name="email" :value="old('email')" type="email"
                    placeholder="Enter your email">
            </div>
            <div class="username mb-[1rem]">
                <i data-feather="user" class="icon-form"></i>
                <input class="form" id="name" name="name" :value="old('name')" type="text"
                    placeholder="Enter your username">
            </div>
            <div class="password mb-[1rem]">
                <i data-feather="lock" class="icon-form"></i>
                <input class="form" name="password" id="password" type="password" placeholder="Enter your password">
            </div>
            <div class="con-password mb-[4rem]">
                <i data-feather="lock" class="icon-form"></i>
                <input class="form" name="password_confirmation" id="password_confirmation" type="password"
                    placeholder="Re-Enter your password">
            </div>
            <div class="btn-con">
                <a class="text-teal-300" href="{{ route('login') }}">Already Have an Account?</a>
                <button class="btn" type="submit">Register</button>
            </div>
        </form>
    </div>
@endsection
