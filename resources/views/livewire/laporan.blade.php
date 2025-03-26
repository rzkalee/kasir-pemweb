<div class="items-center justify-between bg-[#5C3A2C] h-[450px] px-10 py-5 rounded-lg shadow-md overflow-hidden">
    <div class=" text-[#C5A787] max-w-lg">
        <h1 class="text-5xl font-bold tracking-wide drop-shadow-lg">LAPORAN TRANSAKSI</h1>
        <a href="{{ url('/cetak') }}" target="_blank" class="bg-[#C5A787] text-[#301f17] py-3 px-8 rounded-lg">Cetak</a>
        <table class="bg-[#C5A787]">
            <thead class="text-[#5C3A2C]">
                <th>No</th>
                <th>Tanggal</th>
                <th>No. Inv.</th>
                <th>Total</th>
            </thead>
            <tbody class="text-[#5C3A2C]">
                @foreach ($semuaTransaksi as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaksi->created_at }}</td>
                        <td>{{ $transaksi->kode }}</td>
                        <td>{{ number_format($transaksi->total, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
