<div class="w-64 bg-gray-900 h-screen fixed lg:block hidden" id="sidebar">
    <div class="flex items-center justify-center h-16 bg-gray-800">
        <span class="text-white text-2xl font-semibold">
            Admin INPLIK
        </span>
    </div>
    <nav class="mt-10">
        <a class="flex items-center py-2 px-8 {{ Request::is('admin-dashboard') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}"
            href="{{ url('admin-dashboard') }}">
            <i class="fas fa-home mr-3"></i>
            Dashboard
        </a>
        <a class="flex items-center py-2 px-8 {{ Request::is('admin-input') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}"
            href="{{ url('admin-input') }}">
            <i class="fas fa-edit mr-3"></i>
            Input
        </a>
        <a class="flex items-center py-2 px-8 {{ Request::is('admin-detail') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}"
            href="{{ url('admin-detail') }}">
            <i class="fas fa-info-circle mr-3"></i>
            Detail
        </a>
        <a class="flex items-center py-2 px-8 {{ Request::is('inplik-dashboard') ? 'bg-gray-700 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}"
            href="{{ url('/') }}">
            <i class="fas fa-home mr-3"></i>
            Inplik Dashboard
        </a>
    </nav>
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
