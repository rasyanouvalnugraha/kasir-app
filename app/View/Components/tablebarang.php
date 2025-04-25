<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Barang;

class tablebarang extends Component
{
    public $barang;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->barang = Barang::select('id', 'nama_barang', 'harga_barang', 'jumlah_barang')->paginate(10);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tablebarang');
    }
}
