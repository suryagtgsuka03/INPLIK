<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'Halaman')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex">
        @yield('content')
    </div>

    </div>
    <script>
        document.getElementById('menu-button').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
            } else {
                sidebar.classList.add('hidden');
            }
        });
    </script>
</body>

</html>