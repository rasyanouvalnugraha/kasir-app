<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-200">
    <main class="flex flex-1">
        <div class="m-4">@include('components.navbar-desktop')</div>
        <section class="flex-1 flex flex-col">
            <div class="bg-white shadow-md rounded-lg p-6 mr-4 mt-4 font-mulish-600 flex items-center justify-center">
                <h1 class="text-xl">Transaksi {{ config('app.name') }}</h1>
            </div>
            <section class="bg-white mt-4 shadow-md rounded-lg p-6 mr-4">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('asset/logo1.jpg') }}" alt="" class="h-12 w-12 rounded-full">
                </div>
                <form method="POST" action="{{ route('transaksi.store') }}" id="form-transaksi">
                    @csrf
                    <div id="barang-container">
                        <div class="barang-row grid grid-cols-4 gap-2 flex">
                            <!-- Pilih Barang -->
                            <div class="font-mulish-600">
                                <label class="block text-sm mb-1">Pilih Barang</label>
                                <select name="barang_id[]"
                                    class="barang-select w-full border rounded p-2 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                    <option value="">-- Pilih Barang --</option>
                                    @foreach ($barang as $item)
                                        <option value="{{ $item->id }}" data-stok="{{ $item->jumlah_barang }}"
                                            data-harga="{{ $item->harga_barang }}">
                                            {{ $item->nama_barang }} - Rp{{ number_format($item->harga_barang) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Stok -->
                            <div class="font-mulish-600">
                                <label class="block text-sm mb-1">Stok</label>
                                <input type="text" readonly
                                    class="stok-barang w-full bg-gray-100 border rounded p-2 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- Qty -->
                            <div class="font-mulish-600">
                                <label class="block text-sm mb-1">Qty</label>
                                <input type="number" name="jumlah[]" min="1" required
                                    class="w-full border rounded p-2 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div class="flex items-end font-mulish-600 gap-2">
                                <!-- Tambah -->
                                <div class="flex items-end font-mulish-600">
                                    <button type="button"
                                        class="tambah-barang bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded w-full">+
                                        Barang</button>
                                </div>

                                <!-- Hapus -->
                                <div class="flex items-end font-mulish-600">
                                    <button type="button"
                                        class="hapus-barang bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded w-full hidden">-
                                        Hapus</button>
                                </div>
                            </div>

                            <!-- Subtotal per barang (hidden) -->
                            <input type="hidden" class="subtotal-barang" value="0">
                        </div>
                    </div>

                    <!-- Nama Pelanggan & Uang Bayar -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-mulish-600 mb-1">Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan" required
                                class="w-full font-mulish-600 border rounded p-2 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-mulish-600 mb-1">Uang Bayar</label>
                            <input type="number" name="bayar" required
                                class="w-full font-mulish-600 border rounded p-2 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="mt-6 flex justify-between items-center">
                        <!-- Total -->
                        <div class="mt-2">
                            <span class="text-lg font-mulish-700">Total: Rp<span id="total-harga">0</span></span>
                        </div>
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded font-mulish-700">Buat
                            Transaksi</button>
                    </div>
                </form>
                @if (session('nama_pelanggan'))
                    <script>
                        const success = "{{ session('nama_pelanggan') }}";
                        if (success) {
                            Swal.fire({
                                title: 'Transaksi Berhasil',
                                icon: 'success',
                                confirmButtonText: 'Okay',
                                html: `
                                    <div class="font-mulish-600 flex justify-around">
                                        <a href="{{ route('invoice.nama', session('nama_pelanggan')) }}" target="_blank" class="p-2 bg-indigo-500 text-white rounded-md">Lihat Invoice</a>
                                    </div>
                                `,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/app';
                                }
                            });
                        }
                    </script>
                @endif

            </section>
        </section>
    </main>
    {{-- {{ dd(session()->all()) }} --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form-transaksi');
            const bayarInput = form.querySelector('input[name="bayar"]');

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Cegah submit langsung

                let total = 0;
                document.querySelectorAll('.subtotal-barang').forEach(input => {
                    total += parseInt(input.value.replace(/,/g, '')) || 0;
                });

                const bayar = parseInt(bayarInput.value) || 0;
                const kembalian = bayar - total;

                if (kembalian < 0) {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Uang yang dibayarkan kurang dari total belanja!',
                        icon: 'error',
                        confirmButtonText: 'Cek Lagi'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Konfirmasi Transaksi',
                    html: `
                    <div class="text-center font-mulish-600">
                        <p><strong>Total:</strong> Rp${total.toLocaleString()}</p>
                        <p><strong>Bayar:</strong> Rp${bayar.toLocaleString()}</p>
                        <p><strong>Kembalian:</strong> Rp${kembalian.toLocaleString()}</p>
                    </div>
                `,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit jika dikonfirmasi
                    }
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('barang-container');

            function hitungSubtotal(row) {
                const select = row.querySelector('.barang-select');
                const qtyInput = row.querySelector('input[name="jumlah[]"]');
                const subtotalInput = row.querySelector('.subtotal-barang');

                const harga = parseInt(select.selectedOptions[0]?.getAttribute('data-harga')) || 0;
                const qty = parseInt(qtyInput.value) || 0;
                const subtotal = harga * qty;
                subtotalInput.value = subtotal.toLocaleString();
            }

            function updateTotal() {
                let total = 0;
                document.querySelectorAll('.subtotal-barang').forEach(input => {
                    total += parseInt(input.value.replace(/,/g, '')) || 0;
                });
                document.getElementById('total-harga').innerText = total.toLocaleString();
            }

            container.addEventListener('change', function(e) {
                if (e.target.classList.contains('barang-select') || e.target.name === 'jumlah[]') {
                    const row = e.target.closest('.barang-row');
                    const selectedOption = row.querySelector('.barang-select').selectedOptions[0];
                    const stok = selectedOption?.getAttribute('data-stok') || '-';
                    row.querySelector('.stok-barang').value = stok;
                    hitungSubtotal(row);
                    updateTotal();
                }
            });

            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('tambah-barang')) {
                    const row = e.target.closest('.barang-row');
                    const clone = row.cloneNode(true);
                    clone.querySelectorAll('select, input').forEach(el => el.value = '');
                    clone.querySelector('.hapus-barang').classList.remove('hidden');
                    container.appendChild(clone);
                    updateTotal();
                }

                if (e.target.classList.contains('hapus-barang')) {
                    const row = e.target.closest('.barang-row');
                    if (container.querySelectorAll('.barang-row').length > 1) {
                        row.remove();
                        updateTotal();
                    }
                }
            });
        });
    </script>
</body>

</html>
