<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as Auth;
use App\Http\Controllers\BarangController as Barang;
use App\Http\Controllers\Transaksi as Transaksi;
use App\Http\Controllers\LaporanController as Laporan;


Route::get('/', [Auth::class, 'index']);
Route::post('/', [Auth::class, 'login'])->name('login');
Route::get('/logout', [Auth::class, 'logout'])->name('logout');

// routing untuk proteksi jika halaman mau diaskses tanpa login
// middleware fungsinya untuk mengamankan route
// auth itu sebagai sistem keamanan login, jadi seseorang harus login dan baru bisa mengakses endpoint yang ada
Route::middleware('auth')->group(function () {
    // routing untuk menampilkan halaman app
    Route::get('/app', [Barang::class, 'index'])->name('app');
    // routing untuk menampilkan halaman create barang
    Route::get('/app/create', [Barang::class, 'create']);
    Route::post('/app/create', [Barang::class, 'store'])->name('create');
    // routing untuk menampilkan halaman edit barang
    Route::get('/app/edit/{id}', [Barang::class, 'edit'])->name('edit');
    Route::put('/app/{id}', [Barang::class, 'update'])->name('update');
    Route::delete('/app/{id}', [Barang::class, 'destroy'])->name('destroy');

    // routing untuk menampilkan halaman transaksi
    Route::get('app/transaction', [Transaksi::class, 'index']);
    Route::post('app/transaction', [Transaksi::class, 'store'])->name('transaksi.store');
    // get invoice
    Route::get('/app/transaction/invoice-pelanggan/{nama}', [Transaksi::class, 'invoiceByName'])->name('invoice.nama');


    // // routing untuk menampilkan halaman laporan
    // Route::get('app/laporan', [Laporan::class, 'index'])->name('laporan');
});
