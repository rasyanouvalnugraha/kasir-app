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
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    </head>

    <body class="bg-gray-200">
        <main class="flex flex-1">
            <div class="m-4">@include('components.navbar-desktop')</div>
            <section class="flex-1 flex flex-col" data-aos="fade-left" data-aos-duration="1500">
                <div
                    class="bg-white shadow-md rounded-lg p-6 mr-4 mt-4 font-mulish-600 flex items-center justify-center">
                    <h1 class="text-xl">Transaksi {{ config('app.name') }}</h1>
                </div>
                <section class="bg-white mt-4 shadow-md rounded-lg p-6 mr-4">
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('asset/logo1.jpg') }}" alt="" class="h-12 w-12 rounded-full">
                    </div>
                    <x-formtransaksi />
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
        {{-- cdn animate on scroll --}}
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>


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
                        const stok = parseInt(selectedOption?.getAttribute('data-stok')) || 0;
                        const qtyInput = row.querySelector('input[name="jumlah[]"]');
                        const qty = parseInt(qtyInput.value) || 0;

                        row.querySelector('.stok-barang').value = stok;

                        if (qty > stok) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Stok Tidak Cukup!',
                                text: `Stok tersedia hanya ${stok}, kamu memasukkan ${qty}.`,
                            }).then(() => {
                                qtyInput.value = stok; // reset ke stok maksimal
                                qtyInput.focus(); // autofocus ke input jumlah
                            });
                        }

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
