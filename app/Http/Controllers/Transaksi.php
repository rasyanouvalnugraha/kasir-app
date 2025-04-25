<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;

class Transaksi extends Controller
{
    public function index()
    {
        $barang = Barang::select('id', 'nama_barang', 'harga_barang', 'jumlah_barang')->paginate(10);
        return view('transaction.app', [
            'barang' => $barang,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input awal
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'barang_id.*' => 'required|exists:barang,id',
            'jumlah.*' => 'required|integer|min:1',
            'bayar' => 'required|numeric|min:0',
        ]);

        $total = 0;
        $barangList = [];

        // Hitung total dan validasi stok
        foreach ($request->barang_id as $index => $barangId) {
            $barang = Barang::findOrFail($barangId);
            $jumlah = $request->jumlah[$index];

            if ($barang->jumlah_barang < $jumlah) {
                return back()->with('error', "Stok barang '{$barang->nama_barang}' tidak cukup.");
            }

            $subtotal = $barang->harga_barang * $jumlah;
            $total += $subtotal;

            // Simpan sementara
            $barangList[] = [
                'barang' => $barang,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal,
            ];
        }

        // Validasi uang bayar cukup
        if ($request->bayar < $total) {
            return back()->with('error', 'Uang bayar tidak cukup untuk menyelesaikan transaksi.');
        }

        $transaksi = null;
        // Simpan transaksi dan update stok
        foreach ($barangList as $item) {
            $transaksi = DetailTransaksi::create([
                'nama_pelangganan' => $request->nama_pelanggan,
                'id_barang' => $item['barang']->id,
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['subtotal'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $item['barang']->jumlah_barang -= $item['jumlah'];
            $item['barang']->save();
        }

        return redirect('/app/transaction')->with([
            'messageCreate' => 'success',
            'nama_pelanggan' => $request->nama_pelanggan,
        ]);
    }

    public function invoiceByName($nama)
    {
        // Ambil semua transaksi terakhir milik pelanggan ini
        $orders = DetailTransaksi::with('barang')
            ->where('nama_pelangganan', $nama)
            ->whereDate('created_at', now()->toDateString()) // Biar hanya transaksi hari ini
            ->get();

        if ($orders->isEmpty()) {
            return back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $total = $orders->sum('subtotal');

        return view('transaction.invoice', [
            'orders' => $orders,
            'nama' => $nama,
            'total' => $total,
            'bayar' => $orders->first()->bayar ?? 0,
            'created_at' => $orders->first()->created_at,
        ]);
    }
}
