<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    {{-- tailwind css via cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- icon kasir --}}
    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/x-icon" class="rounded-full">
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=National+Park:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-6 rounded-xl shadow-md my-6 w-96">
        <h1 class="text-2xl font-mulish-700 text-gray-800 mb-4">Edit Data Barang</h1>

        <form action="{{ route('update', $barang->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $barang->id }}">
            <div>
                <label for="nama_barang" class="block text-sm font-mulish-600 text-gray-700 mb-1">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ $barang->nama_barang }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mulish-600">
                @error('nama_barang')
                    <div class="text-red-500 font-mulish-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="jumlah_barang" class="block text-sm font-mulish-600 text-gray-700 mb-1">Jumlah
                    Barang</label>
                <input type="number" name="jumlah_barang" id="jumlah_barang" value="{{ $barang->jumlah_barang }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mulish-600">
                @error('jumlah_barang')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="harga_barang" class="block text-sm font-mulish-600 text-gray-700 mb-1">Harga Barang</label>
                <input type="text" name="harga_barang" id="harga_barang" value="{{ $barang->harga_barang }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mulish-600"
                    placeholder="Rp 0">
                @error('harga_barang')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-mulish-700 py-2 px-4 rounded-lg transition duration-200">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</body>

</html>
