<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Auth')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-no-repeat bg-fixed bg-cover justify-items-center"
    style="background-image: url({{ asset('img/login.jpg') }})">
    <h1 class="text-white text-center text-5xl font-bold mt-40 mb-20">Welcome Back !</h1>
    @yield('content')
</body>

<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>

</html>
