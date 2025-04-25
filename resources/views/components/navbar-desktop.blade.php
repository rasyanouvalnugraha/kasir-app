<section class="hidden md:flex flex-col w-64 bg-indigo-600 h-fit rounded-lg p-4" data-aos="fade-right" data-aos-duration="1500">
    <div class="flex items-center justify-center">
        <img src="{{ asset('asset/logo1.jpg') }}" alt="Logo" class="h-12 w-12 rounded-full">
        <h1 class="p-6 text-white font-mulish-800 text-2xl text-center">{{ config('app.name') }}</h1>
    </div>

    <hr class="w-full border-t-4 border-white mb-4">

    <ul class="space-y-4 px-4">
        <li>
            <a href="/app"
                class="flex items-center gap-3 text-white font-mulish-700 p-2 rounded-md
                      {{ Request::is('app') ? 'bg-indigo-700' : 'bg-indigo-600 hover:bg-indigo-700' }}">
                <img src="{{ asset('asset/Content.svg') }}" alt="Kelola Barang" class="w-6 h-6">
                Kelola Barang
            </a>
        </li>
        <li>
            <a href="/app/transaction"
                class="flex items-center gap-3 text-white font-mulish-700 p-2 rounded-md
                      {{ Request::is('app/transaction') ? 'bg-indigo-700' : 'bg-indigo-600 hover:bg-indigo-700' }}">
                <img src="{{ asset('asset/Coin Wallet.svg') }}" alt="Transaksi" class="w-6 h-6">
                Transaksi
            </a>
        </li>
        {{-- <li>
            <a href="/app/laporan"
                class="flex items-center gap-3 text-white font-mulish-700 p-2 rounded-md
                      {{ Request::is('app/laporan') ? 'bg-indigo-700' : 'bg-indigo-600 hover:bg-indigo-700' }}">
                <img src="{{ asset('asset/Open Document.svg') }}" alt="Laporan" class="w-6 h-6">
                Laporan
            </a>
        </li> --}}
        <li>
            <a href="/logout" id="logout"
                class="flex items-center gap-3 text-white font-mulish-700 p-2 rounded-md
                      hover:bg-red-600 bg-indigo-600">
                <img src="{{ asset('asset/Logout.svg') }}" alt="Logout" class="w-6 h-6">
                Logout
            </a>
        </li>
    </ul>
</section>
