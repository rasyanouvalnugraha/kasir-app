<section class="flex-1 flex flex-col" data-aos="fade-left" data-aos-duration="1500">
    <div class="bg-white shadow-md rounded-lg p-6 mr-4 mt-4 font-mulish-600  flex items-center justify-between">
        <h1 class="text-xl">Daftar Barang {{ config('app.name') }}</h1>
        <a href="/app/create" class="bg-red-600 text-white p-2 rounded-full flex gap-2">
            <img src="{{ asset('asset/Plus Math.svg') }}" alt="" class="w-6 h-6">
            Tambah Barang
        </a>
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
                @foreach ($barang as $data)
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $data->nama_barang }}</td>
                        <td class="px-4 py-3">{{ $data->jumlah_barang }}</td>
                        <td class="px-4 py-3">@currency($data->harga_barang) </td>
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
