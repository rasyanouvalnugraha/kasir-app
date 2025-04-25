<?php

namespace App\Models;

use App\Models\DetailTransaksi;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_barang',
        'jumlah_barang',
        'harga_barang',
    ];
    public $timestamps = false;
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_barang', 'id');
    }
}
