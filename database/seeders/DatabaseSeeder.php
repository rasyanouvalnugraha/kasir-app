<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Barang;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'id' => 1,
            'username' => 'admin',
            'password' => bcrypt('kasir'),
            'role' => 1,
        ]);

        Barang::create([

            'nama_barang' => 'Buku',
            'jumlah_barang' => 10,
            'harga_barang' => 10000,
        ]);
        Barang::create([

            'nama_barang' => 'Buku Tulis',
            'jumlah_barang' => 20,
            'harga_barang' => 15000,
        ]);
    }
}
