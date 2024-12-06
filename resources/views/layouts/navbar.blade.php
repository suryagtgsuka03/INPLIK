<header class="flex items-center justify-between bg-white h-16 px-6 border-b border-gray-200">
    <div class="flex items-center">
        <button class="text-gray-500 focus:outline-none lg:hidden" id="menu-button">
            <i class="fas fa-bars">
            </i>
        </button>
        <div class="relative mx-4 lg:mx-0">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <i class="fas fa-search text-gray-500">
                </i>
            </span>
            <input class="form-input w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" placeholder="Search..."
                type="text" />
        </div>
    </div>
    <div class="flex items-center">
        <a href="dashboard" class="text-gray-500 focus:outline-none mx-4">
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-gray-500 focus:outline-none mx-4 type="submit">LogOut</button>
        </form>
    </div>
</header>
