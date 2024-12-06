@extends('layouts.app')

@section('title', 'Berlangganan')

@section('content')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-your-client-key"></script>

    <div class="md:px-20 py-10 sm:px-1 flex space-x-4">
        @foreach ($langganans as $langganan)
            <button class="open-modal" data-tipe="{{ $langganan->tipe }}" data-id="{{ $langganan->id }}"
                data-harga="{{ $langganan->harga }}">
                <div
                    class="bg-gradient-to-b from-green-900 to-black text-white p-6 rounded-lg shadow-lg w-64 transform transition-all duration-300 hover:scale-105 hover:via-green-800 hover:to-black">
                    <h2 class="text-xl font-semibold mb-2">{{ $langganan->tipe }}</h2>
                    <ul class="mb-4">
                        <li class="flex items-center mb-2">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            {{ $langganan->benefit }}
                        </li>
                    </ul>
                    <p class="text-lg font-semibold">Rp {{ number_format($langganan->harga, 0, ',', '.') }} /bulan</p>
                </div>
            </button>
        @endforeach
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed z-20 inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 max-w-lg w-full">
            <h3 class="text-2xl font-bold text-gray-700 mb-4">Data Langganan</h3>
            <form id="paymentForm" method="POST" action="{{ route('create.payment') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="subTipe" class="block text-sm font-medium text-gray-700">Tipe Langganan</label>
                        <input type="text" id="subTipe" name="tipe" readonly
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 p-3">
                    </div>
                    <div>
                        <label for="subNama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="subNama" name="name" value="{{ auth()->user()->name }}" readonly
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 p-3">
                    </div>
                    <div>
                        <label for="subEmail" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="subEmail" name="email" value="{{ auth()->user()->email }}" readonly
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 p-3">
                    </div>
                    <div>
                        <label for="subHarga" class="block text-sm font-medium text-gray-700">Harga</label>
                        <input type="text" id="subHarga" name="price" readonly
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 p-3">
                    </div>
                    <div class="flex justify-end space-x-4 mt-4">
                        <button type="button" class="bg-gray-300 text-white px-6 py-2 rounded-lg"
                            onclick="closeModal()">Batal</button>
                        <button type="submit" id="pay-button" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Bayar
                            Sekarang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.open-modal').forEach(button => {
            button.addEventListener('click', function() {
                const tipe = this.getAttribute('data-tipe');
                const harga = this.getAttribute('data-harga');
                document.getElementById('subTipe').value = tipe;
                document.getElementById('subHarga').value = harga;
                document.getElementById('modal').classList.remove('hidden');
            });
        });

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Cegah form disubmit langsung

            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: document.getElementById('subNama').value,
                        email: document.getElementById('subEmail').value,
                        price: document.getElementById('subHarga').value,
                        tipe: document.getElementById('subTipe').value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.snapToken) {
                        window.snap.pay(data.snapToken, {
                            onSuccess: function(result) {
                                alert("Payment Success!");
                                console.log('Result:', result);

                                // Kirim status pembayaran ke server
                                fetch('/update-payment-status', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify({
                                            order_id: result.order_id, // Kirim order_id
                                            transaction_status: 'sukses' // Update status ke 'sukses'
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.status === 'success') {
                                            location.reload(); // Refresh halaman
                                        } else {}
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        alert();
                                    });
                            },
                            onPending: function(result) {
                                alert("Payment Pending!");
                            },
                            onError: function(result) {
                                alert("Payment Failed!");
                            },
                            onClose: function() {
                                alert("You closed the payment popup.");
                            }
                        });
                    } else {
                        alert('Gagal mendapatkan Snap Token.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses pembayaran.');
                });
        })
    </script>
@endsection
