<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        // Mengambil semua data barang dari database
        // mengambil data yang diperlukan saja
        $barang = Barang::select('id', 'nama_barang', 'harga_barang', 'jumlah_barang')->paginate(10);
        return view('layouts.app', [
            'barang' => $barang,
        ]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_barang' => 'required|unique:barang,nama_barang',
            'jumlah_barang' => 'required|integer',
            'harga_barang' => 'required|integer',
        ], [
            // Pesan error untuk validasi
            'nama_barang.required' => 'Nama Barang Harus di Isi',
            'nama_barang.unique' => 'Nama Barang Sudah Ada',
            'jumlah_barang.required' => 'Jumlah Barang Harus di Isi',
            'jumlah_barang.integer' => 'Jumlah Barang Harus Angka',
            'harga_barang.required' => 'Harga Barang Harus di Isi',
            'harga_barang.integer' => 'Harga Barang Harus Angka',
        ]);
        // Hapus 'Rp' dan titik, lalu convert ke integer
        // $harga = (int) str_replace(['Rp', '.', ' '], '', $validated['harga_barang']);
        // Simpan data barang ke database
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'harga_barang' => $request->harga_barang,
        ]);

        return redirect('/app')->with('messageCreate', 'success');
    }

    public function edit($id)
    {
        $barang = Barang::where('id', $id)->first();
        return view('edit', [
            'barang' => $barang,
        ]);
    }

    public function update(Request $request, $id) {
        // Validasi input
        $barang = Barang::findOrFail($request->id);
        $validated = $request->validate([
            'nama_barang' => 'required|unique:barang,nama_barang,' . $barang->id,
            'jumlah_barang' => 'required|integer',
            'harga_barang' => 'required|integer',
        ], [
            // Pesan error untuk validasi
            'nama_barang.required' => 'Nama Barang Harus di Isi',
            'nama_barang.unique' => 'Nama Barang Sudah Ada',
            'jumlah_barang.required' => 'Jumlah Barang Harus di Isi',
            'jumlah_barang.integer' => 'Jumlah Barang Harus Angka',
            'harga_barang.required' => 'Harga Barang Harus di Isi',
            'harga_barang.integer' => 'Harga Barang Harus Angka',
        ]);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'harga_barang' => $request->harga_barang,
        ]);
        return redirect('/app')->with('messageEdit', 'success');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect('/app')->with('messageDelete', 'success');
    }

}
