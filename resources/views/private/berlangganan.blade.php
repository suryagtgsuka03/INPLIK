@extends('layouts.appadmin')

@section('title', 'Admin-Berlangganan')

@section('content')
    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col lg:ml-64 bg-gray-50">
        @include('layouts.navbar')
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-8">
                <h3 class="text-gray-700 text-3xl font-bold mb-4">
                    Input Langganan
                </h3>
                <p class="text-gray-500 mb-8">
                    Lengkapi form berikut untuk menambahkan tipe berlangganan baru
                </p>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <form action="{{ route('berlangganan.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="flex flex-wrap gap-4">
                            <div class="flex-1 min-w-[200px]">
                                <label for="tipe_langganan" class="block text-sm font-medium text-gray-700">
                                    Tipe Langganan
                                </label>
                                <input type="text" id="tipe_langganan" name="tipe_langganan" required
                                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3"
                                    placeholder="Masukkan Tipe Langganan">
                            </div>

                            <div class="flex-1 min-w-[200px]">
                                <label for="manfaat" class="block text-sm font-medium text-gray-700">
                                    Manfaat
                                </label>
                                <textarea id="manfaat" name="manfaat" rows="1" required
                                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3"
                                    placeholder="Masukkan Manfaat yang Diterima"></textarea>
                            </div>

                            <div class="flex-1 min-w-[150px]">
                                <label for="harga" class="block text-sm font-medium text-gray-700">
                                    Harga
                                </label>
                                <input type="number" id="harga" name="harga" required
                                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3"
                                    placeholder="Masukkan Harga">
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <button type="submit"
                                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="container mx-auto px-6 py-8">
                <h3 class="text-gray-700 text-3xl font-bold mb-4">
                    Detail Langganan
                </h3>
                <p class="text-gray-500 mb-8">
                    Tipe tipe berlangganan yang sudah di inputkan
                </p>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 text-left">Tipe</th>
                                <th class="border px-4 py-2 text-left w-[40%]">Benefit</th>
                                <th class="border px-4 py-2 text-left">Harga</th>
                                <th class="border px-4 py-2 text-center w-[15%]">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($langganans as $langganan)
                                <tr id="langganan-{{ $langganan->id }}">
                                    <td class="border px-4 py-2">
                                        {{ $langganan->tipe }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $langganan->benefit }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $langganan->harga }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <button
                                            class="edit-btn bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 text-xs mr-2"
                                            data-id="{{ $langganan->id }}" data-tipe="{{ $langganan->tipe }}"
                                            data-manfaat="{{ $langganan->benefit }}" data-harga="{{ $langganan->harga }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('berlangganan.delete', $langganan->id) }}" method="POST"
                                            class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 text-xs">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Edit Langganan -->
    <div id="editModal"
        class="fixed z-20 inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-opacity">
        <div class="bg-white rounded-lg p-6 max-w-lg w-full">
            <h3 class="text-2xl font-bold text-gray-700 mb-4">Edit Langganan</h3>
            <form id="editForm" method="POST" action="{{ route('berlangganan.edit', 0) }}">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label for="editTipe" class="block text-sm font-medium text-gray-700">Tipe Langganan</label>
                        <input type="text" id="editTipe" name="tipe_langganan" required
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3">
                    </div>

                    <div>
                        <label for="editManfaat" class="block text-sm font-medium text-gray-700">Manfaat</label>
                        <textarea id="editManfaat" name="manfaat" rows="1" required
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3"></textarea>
                    </div>

                    <div>
                        <label for="editHarga" class="block text-sm font-medium text-gray-700">Harga</label>
                        <input type="number" id="editHarga" name="harga" required
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3">
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-4">
                    <button type="button" class="cancel-btn bg-gray-300 text-white px-6 py-2 rounded-lg hover:bg-gray-400"
                        onclick="closeModal()">Batal</button>
                    <button type="submit"
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Memastikan tombol edit dapat mengaktifkan modal
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Mengambil data dari atribut data-*
                const id = this.getAttribute('data-id');
                const tipe = this.getAttribute('data-tipe');
                const manfaat = this.getAttribute('data-manfaat');
                const harga = this.getAttribute('data-harga');

                // Mengisi data ke dalam form modal
                document.getElementById('editTipe').value = tipe;
                document.getElementById('editManfaat').value = manfaat;
                document.getElementById('editHarga').value = harga;

                // Menyesuaikan action form untuk edit
                const form = document.getElementById('editForm');
                form.action = `/admin-berlangganan/${id}`;

                // Menampilkan modal
                document.getElementById('editModal').classList.remove('hidden');
            });
        });

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>

@endsection
