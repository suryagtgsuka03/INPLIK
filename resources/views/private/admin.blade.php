@extends('layouts.appadmin')

@section('title', 'Admin - Dashboard')

@section('content')

    @include('layouts.sidebar')
    <div class="flex-1 flex flex-col lg:ml-64">
        @include('layouts.navbar')
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-8">
                <h3 class="text-gray-700 text-3xl font-medium">
                    Dashboard
                </h3>
                <p class="text-gray-500">
                    Recap INPLIK
                </p>
                <div class="mt-4">
                    <div class="flex flex-wrap -mx-6">
                        <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                <div class="p-3 bg-blue-500 rounded-full">
                                    <i class="fas fa-users text-white">
                                    </i>
                                </div>
                                <div class="mx-5">
                                    <h4 class="text-2xl font-semibold text-gray-700">
                                        1,294
                                    </h4>
                                    <div class="text-gray-500">
                                        Visitors
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                <div class="p-3 bg-blue-500 rounded-full">
                                    <i class="fas fa-user-plus text-white">
                                    </i>
                                </div>
                                <div class="mx-5">
                                    <h4 class="text-2xl font-semibold text-gray-700">
                                        1303
                                    </h4>
                                    <div class="text-gray-500">
                                        Subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                <div class="p-3 bg-green-500 rounded-full">
                                    <i class="fas fa-shopping-cart text-white">
                                    </i>
                                </div>
                                <div class="mx-5">
                                    <h4 class="text-2xl font-semibold text-gray-700">
                                        $1,345
                                    </h4>
                                    <div class="text-gray-500">
                                        Sales
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <div class="flex flex-wrap -mx-6">
                        <div class="w-full px-6 lg:w-2/3">
                            <div class="bg-white rounded-md shadow-sm">
                                <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200">
                                    <h4 class="text-gray-700 text-lg font-semibold">
                                        User Statistics
                                    </h4>
                                    <div class="flex items-center">
                                        <button class="text-gray-500 focus:outline-none mx-2">
                                            Export
                                        </button>
                                        <button class="text-gray-500 focus:outline-none mx-2">
                                            Print
                                        </button>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <img alt="User statistics chart" height="300"
                                        src="https://storage.googleapis.com/a1aa/image/YE2jZ6DsWB7iJB3rXldGjkmCEPqQxDOrjnpeeI0S5QsgRjxTA.jpg"
                                        width="600" />
                                </div>
                            </div>
                        </div>
                        <div class="w-full px-6 lg:w-1/3">
                            <div class="bg-white rounded-md shadow-sm">
                                <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200">
                                    <h4 class="text-gray-700 text-lg font-semibold">
                                        Daily Sales
                                    </h4>
                                    <button class="text-gray-500 focus:outline-none">
                                        Export
                                    </button>
                                </div>
                                <div class="p-5">
                                    <h4 class="text-4xl font-semibold text-gray-700">
                                        $4,578.58
                                    </h4>
                                    <p class="text-gray-500">
                                        March 25 - April 02
                                    </p>
                                    <img alt="Daily sales chart" height="150"
                                        src="https://storage.googleapis.com/a1aa/image/pG8D7J3MnBKeHCifcWHSUNJ5s5hm2DvCQDwmfY4XJHbeFNGPB.jpg"
                                        width="300" />
                                </div>
                            </div>
                            <div class="mt-4 bg-white rounded-md shadow-sm">
                                <div class="p-5">
                                    <h4 class="text-2xl font-semibold text-gray-700">
                                        17
                                    </h4>
                                    <p class="text-gray-500">
                                        Users online
                                    </p>
                                    <p class="text-green-500 text-lg font-semibold">
                                        +5%
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <div class="bg-white rounded-md shadow-sm p-5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img alt="Kaiaadmin logo" class="h-10 w-10 rounded-full object-cover" height="40"
                                    src="https://storage.googleapis.com/a1aa/image/jfX4nTo5opxsNCHEno09dR6lroyEmeb3grekcmr7mYfKGNGPB.jpg"
                                    width="40" />
                                <div class="ml-3">
                                    <h4 class="text-gray-700 text-lg font-semibold">
                                        Kaiaadmin
                                    </h4>
                                    <p class="text-gray-500">
                                        Premium Bootstrap 5 Admin Dashboard
                                    </p>
                                </div>
                            </div>
                            <button class="text-gray-500 focus:outline-none">
                                <i class="fas fa-times">
                                </i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
