<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        .barcode { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Daftar Produk dan Barcode</h2>
    @foreach ($produk as $p)
        <div class="barcode">
            <p><strong>{{ $p->nama }} ({{ $p->kode }})</strong></p>
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($p->kode, 'C128') }}" alt="barcode">
        </div>
    @endforeach
</body>
</html>
