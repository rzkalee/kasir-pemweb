<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi - Dewata Ethnic</title>

    <!-- Bootstrap (opsional, untuk grid & table) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #000;
        }

        .report-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .report-header h2 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }

        .report-header h5 {
            margin: 0;
            font-weight: normal;
        }

        .info-table {
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 4px 8px;
        }

        @media print {
            .btn-cetak {
                display: none;
            }

            table {
                font-size: 12px;
            }

            .signature {
                margin-top: 80px;
            }
        }

        .signature {
            margin-top: 60px;
            text-align: right;
        }

        .signature p {
            margin-bottom: 80px;
        }
    </style>
</head>
<body>

    <div class="container mt-4">

        <!-- Header -->
        <div class="report-header">
            <h2>Dewata Ethnic</h2>
            <h5>Laporan Transaksi</h5>
            <small>Tanggal Cetak: {{ now()->format('d F Y') }}</small>
        </div>

        <!-- Tabel Transaksi -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 20%;">Tanggal</th>
                    <th>No. Inv</th>
                    <th>Total</th>
                    <th>Kasir</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semuaTransaksi as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d/m/Y H:i') }}</td>
                        <td>{{ $transaksi->kode }}</td>
                        <td>Rp. {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                        <td>{{ $transaksi->kasir->name ?? 'Tidak Diketahui' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Signature -->
        <div class="signature">
            <p>Disetujui oleh,</p>
            <p><strong>Manager / Atasan</strong></p>
        </div>

        <!-- Tombol Cetak -->
        <button class="btn btn-primary btn-cetak mt-3" onclick="window.print()">Cetak Laporan</button>
    </div>

</body>
</html>
