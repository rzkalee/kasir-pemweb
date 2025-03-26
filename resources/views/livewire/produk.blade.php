<div class="max-w-6xl mx-auto p-6 bg-[#5C3A2C] shadow-md rounded-lg">
    <!-- Menu Navigasi -->
    <div class="flex space-x-4 mb-4">
        <button wire:click="pilihMenu('lihat')" 
            class="px-4 py-2 rounded-md transition 
                {{ $pilihanMenu == 'lihat' ? 'bg-[#A67C52] text-white' : 'border border-[#A67C52] text-[#A67C52] hover:bg-[#A67C52] hover:text-white' }}">
            Semua Produk
        </button>
        <button wire:click="pilihMenu('tambah')" 
            class="px-4 py-2 rounded-md transition 
                {{ $pilihanMenu == 'tambah' ? 'bg-[#A67C52] text-white' : 'border border-[#A67C52] text-[#A67C52] hover:bg-[#A67C52] hover:text-white' }}">
            Tambah Produk
        </button>
        <button wire:click="pilihMenu('excel')" 
            class="px-4 py-2 rounded-md transition 
                {{ $pilihanMenu == 'excel' ? 'bg-[#A67C52] text-white' : 'border border-[#A67C52] text-[#A67C52] hover:bg-[#A67C52] hover:text-white' }}">
            Import Produk
        </button>
        <button wire:loading class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md cursor-not-allowed">
            Loading . . .
        </button>
    </div>

    <!-- Konten -->
    <div>
        @if ($pilihanMenu == 'lihat')
        <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-[#5C3A2C] text-white">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Kode</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Harga</th>
                    <th class="px-4 py-2">Stok</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($semuaProduk as $produk)
                <tr class="border-t">
                    <td class="px-4 py-2 text-white">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 text-white">{{ $produk->kode }}</td>
                    <td class="px-4 py-2 text-white">{{ $produk->nama }}</td>
                    <td class="px-4 py-2 text-white">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 text-white">{{ $produk->stok }} pcs</td>
                    <td class="px-4 py-2 flex justify-center space-x-2">
                        <button wire:click="pilihEdit({{ $produk->id }})"
                            class="px-3 py-1 rounded-md text-white bg-green-600 hover:bg-green-700 transition">
                            Edit
                        </button>
                        <button wire:click="pilihHapus({{ $produk->id }})"
                            class="px-3 py-1 rounded-md text-white bg-red-600 hover:bg-red-700 transition">
                            Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @elseif ($pilihanMenu == 'tambah' || $pilihanMenu == 'edit')
        <form wire:submit.prevent="{{ $pilihanMenu == 'tambah' ? 'simpan' : 'simpanEdit' }}" class="space-y-4">
            <div>
                <label class="block text-white">Kode</label>
                <input type="number" class="w-full px-4 py-2 border rounded-lg focus:ring-[#A67C52] focus:border-[#A67C52]" wire:model="kode">
                @error('kode') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-white">Nama</label>
                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-[#A67C52] focus:border-[#A67C52]" wire:model="nama">
                @error('nama') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-white">Harga</label>
                <input type="number" class="w-full px-4 py-2 border rounded-lg focus:ring-[#A67C52] focus:border-[#A67C52]" wire:model="harga">
                @error('harga') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-white">Stok</label>
                <input type="number" class="w-full px-4 py-2 border rounded-lg focus:ring-[#A67C52] focus:border-[#A67C52]" wire:model="stok">
                @error('stok') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="px-4 py-2 text-white bg-[#A67C52] rounded-lg hover:bg-[#8F5E3A] transition">
                    Simpan
                </button>
                @if ($pilihanMenu == 'edit')
                <button type="button" wire:click="batal" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-600 transition">
                    Batal
                </button>
                @endif
            </div>
        </form>

        @elseif ($pilihanMenu == 'hapus')
        <div class="p-6 border rounded-lg bg-red-50">
            <h2 class="text-lg font-semibold text-red-600">Hapus Produk</h2>
            <p class="text-gray-700">Anda yakin ingin menghapus produk ini?</p>
            <p class="font-bold">Nama: {{ $produkTerpilih->nama }}</p>
            <div class="flex space-x-2 mt-4">
                <button wire:click="hapus" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                    Hapus
                </button>
                <button wire:click="batal" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-600 transition">
                    Batal
                </button>
            </div>
        </div>

        @elseif ($pilihanMenu == 'excel')
        <div class="p-6 border rounded-lg bg-blue-50">
            <h2 class="text-lg font-semibold text-blue-600">Import Produk</h2>
            <form wire:submit.prevent="imporExcel">
                <input type="file" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" wire:model="fileExcel">
                <button type="submit" class="mt-4 px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                    Kirim
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
