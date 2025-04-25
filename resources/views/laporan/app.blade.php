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

<body class="bg-gray-200">
    <main class="flex flex-1">
        <div class="m-4">
            @include('components.navbar-desktop')
        </div>
        <section class="flex-1 flex flex-col">
            <div class="bg-white shadow-md rounded-lg p-6 mr-4 mt-4 font-mulish-600  flex items-center justify-between">
                <h1 class="text-xl">Laporan {{ config('app.name') }}</h1>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6 mr-4 my-4 overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700 font-mulish-600">
                    <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="px-4 py-3 rounded-tl-xl">No</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Jumlah</th>
                            <th class="px-4 py-3">Harga</th>
                            <th class="px-4 py-3 rounded-tr-xl">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($laporan as $data)
                            <tr class="hover:bg-gray-50 transition-all duration-200">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $data->nama_pelangganan }}</td>
                                <td class="px-4 py-3">{{ $data->jumlah }}</td>
                                <td class="px-4 py-3">@currency($data->subtotal) </td>
                                <td class="px-4 py-3 space-x-2 flex">
                                    <a href="/app/edit/{{ $data->id }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md shadow-sm transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md shadow-sm transition">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
