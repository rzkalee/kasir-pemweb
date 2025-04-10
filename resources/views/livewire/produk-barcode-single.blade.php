<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h2>{{ $produk->nama }}</h2>
    <p>Kode: {{ $produk->kode }}</p>
    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk->kode, 'C128') }}" alt="barcode">
</body>
</html>
