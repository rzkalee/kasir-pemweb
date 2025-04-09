<div class="bg-[#5C3A2C] w-full min-h-[450px] mt-10 p-6 rounded-lg shadow-lg">
    <!-- Judul Laporan -->
    <div class="text-[#C5A787] p-5">
        <h1 class="text-3xl font-bold uppercase tracking-wide drop-shadow-lg text-center">LAPORAN TRANSAKSI</h1>

        <div class="flex mt-5 ">

            <div class="flex">
                <label for="kasir">Kasir</label>
                <select wire:model="kasir" id="kasir" class="bg-[#4B2E1C] rounded-3xl border border-[#A67C52] text-white shadow-2xl px-2 py-1">
                    <option value="">Semua Kasir</option>
                    @foreach($kasirs as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>                
            </div>
    
            <div class="flex">
                <label for="tanggalMulai">Dari Tanggal</label>
                <input wire:model="tanggalMulai" type="date" id="tanggalMulai" class="bg-[#4B2E1C] rounded-3xl border border-[#A67C52] text-white shadow-2xl px-2 py-1">
                -
                <input wire:model="tanggalSampai" type="date" id="tanggalSampai" class="bg-[#4B2E1C] rounded-3xl border border-[#A67C52] text-white shadow-2xl px-2 py-1">
            </div>

            <div class="flex">
                <label for="bulan">Bulan</label>
                <select wire:model="bulan" id="bulan" class="bg-[#4B2E1C] rounded-3xl border border-[#A67C52] text-white shadow-2xl px-2 py-1">
                    <option value="">Semua Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>

            <div class="flex gap-4 mt-4">
                <button wire:click="filter" class="bg-[#A67C52] text-white px-4 py-2 rounded-lg shadow-md hover:bg-[#8C5E3C]">
                    Filter
                </button>
                <button wire:click="resetFilter" class="bg-[#C5A787] text-[#301f17] px-4 py-2 rounded-lg shadow-md hover:bg-[#bfa073]">
                    Reset
                </button>
            </div>            

        </div>
        <a 
            href="{{ url('/cetak') . '?' . http_build_query([
                'kasir' => $kasir,
                'tanggalMulai' => $tanggalMulai,
                'tanggalSelesai' => $tanggalSelesai,
                'bulan' => $bulan
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
                    <th class="px-4 py-2">Kasir</th> <!-- Tambah kolom kasir -->
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
