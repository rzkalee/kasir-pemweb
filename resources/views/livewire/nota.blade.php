<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background: #ddd; }
    </style>
</head>
<body>
    <h2>Nota Pembelian</h2>
    <p>No Invoice: {{ $transaksi->kode }}</p>
    <p>Tanggal: {{ $transaksi->created_at->format('d/m/Y H:i') }}</p>
    <p>Kasir: {{ $transaksi->kasir->name }}</p>


    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->produk->nama }}</td>
                <td>Rp {{ number_format($item->produk->harga, 2, ',', '.') }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp {{ number_format($item->jumlah * $item->produk->harga, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total: Rp {{ number_format($transaksi->total, 0, ',', '.') }}</h3>
    <p>Terima kasih telah berbelanja!</p>
</body>
</html>
