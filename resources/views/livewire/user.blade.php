<div class="bg-[#4E2A1D]">
    <div class="">
        <!-- Tombol Navigasi -->
        <div class="flex space-x-4">
            <button wire:click="pilihMenu('lihat')" 
                class="px-6 py-2 rounded-lg text-white transition 
                    {{ $pilihanMenu == 'lihat' ? 'bg-[#A67C52]' : 'bg-[#5C3A2C] hover:bg-[#A67C52]' }}">
                <p>Semua Pengguna<p>
            </button>
            <button wire:click="pilihMenu('tambah')" 
                class="px-6 py-2 rounded-lg text-white transition 
                    {{ $pilihanMenu == 'tambah' ? 'bg-[#A67C52]' : 'bg-[#5C3A2C] hover:bg-[#A67C52]' }}">
                Tambah Pengguna
            </button>
            <button wire:loading class="px-6 py-2 rounded-lg bg-[#8B5E3C] text-white">
                Loading . . .
            </button>
        </div>

        <!-- Tabel Data Pengguna -->
        @if ($pilihanMenu == 'lihat')
        <div class="bg-[#5C3A2C] w-full min-h-[450px] mt-10 p-6 rounded-lg shadow-lg">
            <h1 class="text-[#C5A787] text-3xl font-bold uppercase tracking-wide drop-shadow-lg text-center mb-4">
                DAFTAR PENGGUNA
            </h1>
            <table class="w-full border border-[#A67C52] text-center">
                <thead class="bg-[#A67C52] text-white">
                    <tr>
                        <th class="py-3">No</th>
                        <th class="py-3">Nama</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">Peran</th>
                        <th class="py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($semuaPengguna as $index => $pengguna)
                    <tr class="border border-[#A67C52]">
                        <td class="py-3">{{ $semuaPengguna->firstItem() + $index }}</td>
                        <td class="py-3">{{ $pengguna->name }}</td>
                        <td class="py-3">{{ $pengguna->email }}</td>
                        <td class="py-3">{{ $pengguna->role }}</td>
                        <td class="py-3">
                            <button wire:click="pilihEdit({{ $pengguna->id }})" 
                                class="px-4 py-1 bg-[#A67C52] text-white rounded-lg hover:bg-[#8B5E3C] transition">
                                Edit
                            </button>
                            <button wire:click="pilihHapus({{ $pengguna->id }})"
                                class="px-4 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
            <!-- Pagination -->
            <div class="mt-6 flex justify-center">
                <div class="flex items-center space-x-1 bg-[#A67C52] text-white rounded-full px-3 py-1 shadow-md">
                    
                    <!-- Tombol Prev -->
                    @if ($semuaPengguna->onFirstPage())
                        <span class="px-2 py-1 flex items-center bg-[#8B5E3C] rounded-full cursor-not-allowed opacity-50 text-sm">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" 
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Prev
                        </span>
                    @else
                        <a href="{{ $semuaPengguna->previousPageUrl() }}" 
                            class="px-2 py-1 flex items-center bg-[#5C3A2C] rounded-full hover:bg-[#8B5E3C] transition duration-300 text-sm">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" 
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Prev
                        </a>
                    @endif
            
                    <!-- Nomor Halaman -->
                    @foreach ($semuaPengguna->links()->elements[0] as $page => $url)
                        @if ($page == $semuaPengguna->currentPage())
                            <span class="px-2 py-1 bg-white text-[#A67C52] font-bold rounded-full shadow-sm text-sm">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" 
                                class="px-2 py-1 bg-[#5C3A2C] rounded-full hover:bg-[#8B5E3C] transition duration-300 text-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
            
                    <!-- Tombol Next -->
                    @if ($semuaPengguna->hasMorePages())
                        <a href="{{ $semuaPengguna->nextPageUrl() }}" 
                            class="px-2 py-1 flex items-center bg-[#5C3A2C] rounded-full hover:bg-[#8B5E3C] transition duration-300 text-sm">
                            Next
                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" stroke-width="2" 
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @else
                        <span class="px-2 py-1 flex items-center bg-[#8B5E3C] rounded-full cursor-not-allowed opacity-50 text-sm">
                            Next
                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" stroke-width="2" 
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    @endif
            
                </div>
            </div>                              
        </div>
        

        <!-- Form Tambah & Edit Pengguna -->
        @elseif ($pilihanMenu == 'tambah' || $pilihanMenu == 'edit')
        <div class="bg-[#5C3A2C] w-full h-auto mt-10 p-6 rounded-lg shadow-lg">
            <form wire:submit.prevent="{{ $pilihanMenu == 'tambah' ? 'simpan' : 'simpanEdit' }}">
                <label class="block mb-2">Nama</label>
                <input type="text" class="w-full p-2 border rounded-md bg-white text-black" wire:model='nama'>
                @error('nama') <span class="text-red-500">{{ $message }}</span> @enderror
                
                <label class="block mt-4">Email</label>
                <input type="text" class="w-full p-2 border rounded-md bg-white text-black" wire:model='email'>
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror

                <label class="block mt-4">Password</label>
                <input type="password" class="w-full p-2 border rounded-md bg-white text-black" wire:model='password'>
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror

                <label class="block mt-4">Peran</label>
                <select class="w-full p-2 border rounded-md bg-white text-black" wire:model='peran'>
                    <option value="">-- Pilih Peran --</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="manager">Manager</option>
                </select>
                @error('peran') <span class="text-red-500">{{ $message }}</span> @enderror

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

        <!-- Konfirmasi Hapus Pengguna -->
        @elseif ($pilihanMenu == 'hapus')
        <div class="bg-[#5C3A2C] w-full h-auto mt-10 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold">Konfirmasi Hapus</h2>
            <p class="mt-4">Anda yakin ingin menghapus pengguna ini?</p>
            <p class="mt-2 font-semibold">Nama: {{ $penggunaTerpilih->name }}</p>
            <p class="mt-2 font-semibold">Peran: {{ $penggunaTerpilih->role }}</p>
            <div class="mt-6 flex space-x-4">
                <button class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-800 transition" wire:click='hapus'>
                    Hapus
                </button>
                <button class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-700 transition" wire:click='batal'>
                    Batal
                </button>
            </div>
        </div>
        @endif
    </div>

</div>