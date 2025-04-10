<div class="bg-[#5C3A2C] w-full min-h-[450px] mt-10 p-6 rounded-lg shadow-lg">

    <!-- Judul Laporan -->
    <div class="text-[#C5A787] p-5">
        <h1 class="text-3xl font-bold uppercase tracking-wide drop-shadow-lg text-center">
            LAPORAN TRANSAKSI
        </h1>

        <!-- Filter Section -->
        <div class="flex flex-wrap gap-6 mt-5">

            <!-- Filter Kasir -->
            <div class="flex flex-col">
                <label for="kasir" class="text-white mb-1">Kasir</label>
                <select wire:model="kasir" id="kasir"
                    class="bg-[#4B2E1C] rounded-3xl border border-[#A67C52] text-white shadow-2xl px-4 py-2">
                    <option value="">Semua Kasir</option>
                    @foreach($kasirs as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <!-- Filter Tanggal -->
            <div class="flex flex-col">
                <label for="tanggalMulai" class="text-white mb-1">Dari Tanggal</label>
                <div class="flex items-center gap-2">
                    <input wire:model="tanggalMulai" type="date" id="tanggalMulai"
                        class="bg-[#4B2E1C] rounded-3xl border border-[#A67C52] text-white shadow-2xl px-4 py-2">
                    <span class="text-white">-</span>
                    <input wire:model="tanggalSampai" type="date" id="tanggalSampai"
                        class="bg-[#4B2E1C] rounded-3xl border border-[#A67C52] text-white shadow-2xl px-4 py-2">
                </div>
            </div>
        
            <!-- Filter Bulan & Tahun -->
            <div class="flex flex-col">
                <label for="bulan" class="text-white mb-1">Bulan & Tahun</label>
                <div class="flex gap-2">
                    <select wire:model="bulan" id="bulan"
                        class="bg-[#4B2E1C] rounded-3xl border border-[#A67C52] text-white shadow-2xl px-4 py-2">
                        <option value="">Semua Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                        @endfor
                    </select>
        
                    <select wire:model="tahun" id="tahun"
                        class="bg-[#4B2E1C] rounded-3xl border border-[#A67C52] text-white shadow-2xl px-4 py-2">
                        <option value="">Semua Tahun</option>
                        @foreach ($daftarTahun as $thn)
                            <option value="{{ $thn }}">{{ $thn }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        
            <!-- Tombol Aksi -->
            <div class="flex items-end gap-4">
                <button wire:click="filter"
                    class="bg-[#A67C52] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#8C5E3C]">
                    Filter
                </button>
                <button wire:click="resetFilter"
                    class="bg-[#C5A787] text-[#301f17] px-4 py-2 rounded-lg shadow-md hover:bg-[#bfa073]">
                    Reset
                </button>
            </div>
        
        </div>        

        <!-- Tombol Cetak -->
        <a 
            href="{{ url('/cetak') . '?' . http_build_query([
                'kasir' => $kasir,
                'tanggalMulai' => $tanggalMulai,
                'tanggalSelesai' => $tanggalSelesai,
                'bulan' => $bulan,
                'tahun' => $tahun
            ]) }}" 
            target="_blank" 
            class="bg-[#C5A787] text-[#301f17] py-3 px-8 rounded-lg mt-4 inline-block"
        >
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
                    <th class="px-4 py-2">Kasir</th>
                </tr>
            </thead>
            <tbody class="text-center text-[#5C3A2C]">
                @forelse ($semuaTransaksi as $transaksi)
                    <tr class="border-t">
                        <td class="px-4 py-2 text-white">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 text-white">{{ $transaksi->created_at }}</td>
                        <td class="px-4 py-2 text-white">{{ $transaksi->kode }}</td>
                        <td class="px-4 py-2 text-white">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 text-white">
                            {{ $transaksi->kasir->name ?? 'Tidak Diketahui' }}
                        </td>
                    </tr>
                @empty
                    @if ($sudahFilter)
                        <tr>
                            <td colspan="5" class="py-4 text-white italic">Tidak ada data yang sesuai.</td>
                        </tr>
                    @endif
                @endforelse
            </tbody>
        </table>
    </div>

</div>
