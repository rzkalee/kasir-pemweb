<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>

    <!-- Bootstrap CSS (Jika dibutuhkan) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <style>
        /* Styling khusus untuk cetak */
        @media print {
            body {
                font-size: 12px;
            }
            .btn-cetak {
                display: none; /* Sembunyikan tombol cetak saat dicetak */
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        }
    </style>

</head>
<body>

    <div class="container mt-4">
        <div class="text-center">
            <h2 class="mb-3">Laporan Transaksi</h2>
            <p>{{ now()->format('d F Y') }}</p> <!-- Menampilkan tanggal hari ini -->
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>No. Inv</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($semuaTransaksi as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d/m/Y H:i') }}</td>
                        <td>{{ $transaksi->kode }}</td>
                        <td>Rp. {{ number_format($transaksi->total, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn btn-primary btn-cetak mt-3" onclick="window.print()">Cetak Laporan</button>
    </div>

</body>
</html>
