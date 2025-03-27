<div>
    <div class="container">
        <div class="row mt-3">
                <div class="col-12">
                    @if (!$transaksiAktif)
                        <button class="px-8 py-3 text-lg rounded-lg text-white bg-[#C5A787] hover:bg-[#AC8764] transition font-poppins font-semibold tracking-widest uppercase" wire:click='transaksiBaru'>
                            Transaksi Baru
                        </button>
                    @else
                        <button class="px-8 py-3 text-lg rounded-lg text-white bg-[#8B5E3C] hover:bg-[#6D4C41] transition font-poppins font-semibold tracking-widest uppercase" wire:click='batalTransaksi'>
                            Batalkan Transaksi
                        </button>
                    @endif
                    <button class="px-8 py-3 text-lg rounded-lg bg-[#5C3A2C] text-white transition font-poppins font-semibold tracking-widest uppercase" wire:loading>
                        Loading....
                    </button>
                </div>
            </div>                
        @if ($transaksiAktif)
        <div class="flex mt-2 text-[#C5A787] gap-6">
            <div class="w-2/3">
                <div class="p-6 bg-[#5C3A2C] rounded-lg border border-[#A67C52]">
                    <h4 class="text-xl font-semibold">No Invoice : {{ $transaksiAktif->kode }}</h4>
                    <input type="text" class="w-full p-2 mt-2 bg-[#8B5E3C] text-white rounded-lg border border-[#A67C52]" placeholder="No. Invoice" wire:model.live="kode">
                    <table class="w-full mt-4 border border-[#A67C52]">
                        <thead>
                            <tr class="bg-[#A67C52] text-white">
                                <th class="p-2">No</th>
                                <th class="p-2">Kode Barang</th>
                                <th class="p-2">Nama Barang</th>
                                <th class="p-2">Harga</th>
                                <th class="p-2">Jumlah</th>
                                <th class="p-2">Sub Total Bayar</th>
                                <th class="p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaProduk as $produk)
                            <tr class="border-b border-[#A67C52]">
                                <td class="p-2">{{ $loop->iteration }}</td>
                                <td class="p-2">{{ $produk->produk->kode }}</td>
                                <td class="p-2">{{ $produk->produk->nama }}</td>
                                <td class="p-2">{{ number_format($produk->produk->harga, 2, ',', '.') }}</td>
                                <td class="p-2 flex items-center justify-center gap-2">
                                    <button class="px-2 py-1 bg-red-500 text-white rounded" wire:click="kurangiJumlah({{ $produk->id }})">-</button>
                                    <span>{{ $produk->jumlah }}</span>
                                    <button class="px-2 py-1 bg-green-500 text-white rounded" wire:click="tambahJumlah({{ $produk->id }})">+</button>
                                </td>
                                <td class="p-2">{{ number_format($totalSemuaBelanja, 2, ',', '.') }}</td>
                                <td class="p-2">
                                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg" wire:click="hapusProduk({{ $produk->id }})">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="w-1/3 flex flex-col gap-2">
                <div class="p-6 bg-[#5C3A2C] rounded-lg border border-[#A67C52]">
                    <h4 class="text-xl font-semibold">Total Biaya</h4>
                    <div class="flex justify-between mt-2 text-lg">
                        <span>Rp.</span>
                        <span>{{ number_format($totalSemuaBelanja, 2, ',', '.') }}</span>
                    </div>
                </div>
                <div class="p-6 bg-[#5C3A2C] rounded-lg border border-[#A67C52]">
                    <h4 class="text-xl font-semibold">Bayar</h4>
                    <input type="number" class="w-full p-2 mt-2 bg-[#8B5E3C] text-white rounded-lg border border-[#A67C52]" placeholder="Masukan Nominal..." wire:model.live="bayar">
                </div>
                <div class="p-6 bg-[#5C3A2C] rounded-lg border border-[#A67C52]">
                    <h4 class="text-xl font-semibold">Kembalian</h4>
                    <div class="flex justify-between mt-2 text-lg">
                        <span>Rp.</span>
                        <span>{{ number_format($kembalian, 2, ',', '.') }}</span>
                    </div>
                </div>
                @if($bayar)
                    @if ($kembalian < 0)
                    <div class="mt-2 p-4 bg-red-600 text-white rounded-lg">
                        Uang Kurang
                    </div>
                    @elseif ($kembalian >= 0)
                    <button class="w-full mt-2 px-6 py-3 bg-green-600 text-white font-semibold rounded-lg uppercase tracking-wider" wire:click='transaksiSelesai'>Bayar</button>
                    @endif
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
