<?php

namespace App\Models;
use App\Models\Transaksi;
use App\Models\Barang;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_barang',
        'nama_pelangganan',
        'jumlah',
        'subtotal',
        'bayar'
    ];
    public $timestamps = true;
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
}
