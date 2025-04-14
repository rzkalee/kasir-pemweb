<div class="bg-[#4E2A1D] rounded-lg shadow-lg">
    <!-- Tombol Navigasi -->
    <div class="flex space-x-4">
        <button wire:click="pilihMenu('lihat')" 
            class="px-6 py-2 rounded-lg text-white transition 
                {{ $pilihanMenu == 'lihat' ? 'bg-[#A67C52]' : 'bg-[#5C3A2C] hover:bg-[#A67C52]' }}">
            Semua Produk
        </button>
        <button wire:click="pilihMenu('tambah')" 
            class="px-6 py-2 rounded-lg text-white transition 
                {{ $pilihanMenu == 'tambah' ? 'bg-[#A67C52]' : 'bg-[#5C3A2C] hover:bg-[#A67C52]' }}">
            Tambah Produk
        </button>
        <button wire:click="pilihMenu('excel')" 
            class="px-6 py-2 rounded-lg text-white transition 
                {{ $pilihanMenu == 'excel' ? 'bg-[#A67C52]' : 'bg-[#5C3A2C] hover:bg-[#A67C52]' }}">
            Import Produk
        </button>
        <button wire:loading class="px-6 py-2 rounded-lg bg-[#8B5E3C] text-white">
            Loading . . .
        </button>
    </div>

    <!-- Tabel Data Produk -->
    @if ($pilihanMenu == 'lihat')
    <div class="bg-[#5C3A2C] w-full min-h-[450px] mt-10 p-6 rounded-lg shadow-lg">
        <h1 class="text-[#C5A787] text-3xl font-bold uppercase tracking-wide drop-shadow-lg text-center">
            DAFTAR PRODUK
        </h1>
        <div class="flex justify-end space-x-2 mb-4">
            <button wire:click="cetakSemua('pdf')" class="px-4 py-2 bg-[#A67C52] text-white rounded-lg hover:bg-[#8B5E3C] transition">
                Cetak Semua (PDF)
            </button>
        </div>        
        <table class="w-full border border-[#A67C52] text-center">
            <thead class="bg-[#A67C52] text-white">
                <tr>
                    <th class="py-3">No</th>
                    <th class="py-3">Kode</th>
                    <th class="py-3">Nama</th>
                    <th class="py-3">Harga</th>
                    <th class="py-3">Stok</th>
                    <th class="py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($semuaProduk as $index => $produk)
                <tr class="border border-[#A67C52]">
                    <td class="py-3">{{ $semuaProduk->firstItem() + $index }}</td>
                    <td class="py-3">{{ $produk->kode }}</td>
                    <td class="py-3">{{ $produk->nama }}</td>
                    <td class="py-3">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td class="py-3">{{ $produk->stok }} pcs</td>
                    <td class="py-3">
                        <button wire:click="pilihEdit({{ $produk->id }})" 
                            class="px-4 py-1 bg-[#A67C52] text-white rounded-lg hover:bg-[#8B5E3C] transition">
                            Edit
                        </button>
                        <button wire:click="pilihHapus({{ $produk->id }})"
                            class="px-4 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Hapus
                        </button>
                        <button wire:click="cetakSatu({{ $produk->id }})"
                            class="px-4 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                            Cetak
                        </button>                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination Livewire otomatis dengan Tailwind --}}
        <div class="mt-6">
            {{ $semuaProduk->links() }} 
        </div>
    </div>
    
    <!-- Form Tambah & Edit Produk -->
    @elseif ($pilihanMenu == 'tambah' || $pilihanMenu == 'edit')
    <div class="bg-[#5C3A2C] w-full h-auto mt-10 p-6 rounded-lg shadow-lg">
        <form wire:submit.prevent="{{ $pilihanMenu == 'tambah' ? 'simpan' : 'simpanEdit' }}">
            <label class="block mb-2 text-white">Kode</label>
            <input type="text" class="w-full p-2 border rounded-md bg-white text-black" wire:model='kode'>
            @error('kode') <span class="text-red-500">{{ $message }}</span> @enderror
            
            <label class="block mt-4 text-white">Nama</label>
            <input type="text" class="w-full p-2 border rounded-md bg-white text-black" wire:model='nama'>
            @error('nama') <span class="text-red-500">{{ $message }}</span> @enderror
            
            <label class="block mt-4 text-white">Harga</label>
            <input type="number" class="w-full p-2 border rounded-md bg-white text-black" wire:model='harga'>
            @error('harga') <span class="text-red-500">{{ $message }}</span> @enderror
            
            <label class="block mt-4 text-white">Stok</label>
            <input type="number" class="w-full p-2 border rounded-md bg-white text-black" wire:model='stok'>
            @error('stok') <span class="text-red-500">{{ $message }}</span> @enderror
            
            <div class="mt-6 flex space-x-4">
                <button type="submit" class="px-6 py-2 bg-[#A67C52] text-white rounded-lg hover:bg-[#8B5E3C] transition">
                    Simpan
                </button>
                @if ($pilihanMenu == 'edit')
                <button type="button" wire:click='batal' class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-700 transition">
                    Batal
                </button>
                @endif
            </div>
        </form>
    </div>
    
    <!-- Konfirmasi Hapus Produk -->
    @elseif ($pilihanMenu == 'hapus')
    <div class="bg-[#5C3A2C] w-full h-auto mt-10 p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold text-white">Konfirmasi Hapus</h2>
        <p class="mt-4 text-white">Anda yakin ingin menghapus produk ini?</p>
        <p class="mt-2 font-semibold text-white">Nama: {{ $produkTerpilih->nama }}</p>
        <div class="mt-6 flex space-x-4">
            <button class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-800 transition" wire:click='hapus'>
                Hapus
            </button>
            <button class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-700 transition" wire:click='batal'>
                Batal
            </button>
        </div>
    </div>

    @elseif ($pilihanMenu == 'excel')
    <div class="bg-[#5C3A2C] w-full h-auto mt-10 p-6 rounded-lg shadow-lg0">
        <h2 class="text-xl font-bold text-white">Import Produk</h2>
        <form wire:submit.prevent="imporExcel">
            <input type="file" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" wire:model="fileExcel">
            <button type="submit" class="mt-4 px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                Kirim
            </button>
        </form>
    </div>
    @endif
</div>
