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
