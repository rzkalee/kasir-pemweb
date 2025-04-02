<div class="max-w-6xl mx-auto p-6 bg-[#5C3A2C] rounded-lg shadow-md overflow-hidden">
    <!-- Judul Laporan -->
    <div class="text-[#C5A787] max-w-lg mb-6">
        <h1 class="text-5xl font-bold tracking-wide drop-shadow-lg">LAPORAN TRANSAKSI</h1>
        <a href="{{ url('/cetak') }}" target="_blank" class="bg-[#C5A787] text-[#301f17] py-3 px-8 rounded-lg mt-4 inline-block">
            Cetak
        </a>
    </div>

    <!-- Tabel Laporan -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-[#C5A2C] text-white">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">No. Inv.</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Kasir</th> <!-- Tambah kolom kasir -->
                </tr>
            </thead>
            <tbody class="text-center text-[#5C3A2C]">
                @foreach ($semuaTransaksi as $transaksi)
                    <tr class="border-t">
                        <td class="px-4 py-2 text-white">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 text-white">{{ $transaksi->created_at }}</td>
                        <td class="px-4 py-2 text-white">{{ $transaksi->kode }}</td>
                        <td class="px-4 py-2 text-white">Rp {{ number_format($transaksi->total, 2, ',', '.') }}</td>
                        <td class="px-4 py-2 text-white">
                            {{ $transaksi->kasir->name ?? 'Tidak Diketahui' }} <!-- Nama kasir -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
