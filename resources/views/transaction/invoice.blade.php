<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/x-icon">
    <title>Invoice</title>
    <style>
        .container {
            width: 60%;
            margin: auto;
            font-family: sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .flex-container,
        .flex-container-1 {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }

        .flex-container-1 ul,
        .flex-container ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        hr {
            border-style: dashed;
            margin: 10px 0;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <div class="header">
            <h2>{{ config('app.name') }}</h2>
            <small>STRUK PEMBELIAN BARANG</small><br>
            <small>{{ $created_at->format('d-m-Y H:i:s') }}</small>
        </div>

        <hr>

        <div class="flex-container-1">
            <ul>
                <li>Nama Pelanggan</li>
                <li>Tanggal</li>
            </ul>
            <ul class="text-right">
                <li>{{ $nama }}</li>
                <li>{{ $created_at->format('Y-m-d H:i:s') }}</li>
            </ul>
        </div>

        <hr>

        <div class="flex-container" style="font-weight: bold;">
            <div class="text-left" style="width: 40%;">Nama Barang</div>
            <div class="text-right" style="width: 20%;">Harga</div>
            <div class="text-right" style="width: 15%;">Qty</div>
            <div class="text-right" style="width: 25%;">Total</div>
        </div>

        @foreach ($orders as $item)
            <div class="flex-container">
                <div class="text-left" style="width: 40%;">{{ $item->barang->nama_barang }}</div>
                <div class="text-right" style="width: 20%;">Rp {{ number_format($item->barang->harga_barang) }}</div>
                <div class="text-right" style="width: 15%;">{{ $item->jumlah }}</div>
                <div class="text-right" style="width: 25%;">Rp {{ number_format($item->subtotal) }}</div>
            </div>
        @endforeach

        <hr>
        <div class="flex-container-1">
            <ul>
                <li>Grand Total</li>
                <li>Pembayaran</li>
                <li>Kembalian</li>
            </ul>
            <ul class="text-right">
                <li>Rp {{ number_format($total) }}</li>
                <li>Rp {{ number_format($bayar) }}</li>
                <li>Rp {{ number_format($bayar - $total) }}</li>
            </ul>
        </div>

        <hr>

        <div class="header" style="margin-top: 30px;">
            <h3>Terima kasih</h3>
            <p>Silakan berkunjung kembali</p>
        </div>
    </div>
</body>

</html>
