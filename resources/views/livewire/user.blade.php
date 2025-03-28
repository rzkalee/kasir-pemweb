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
        <div class="bg-[#5C3A2C] w-full h-auto mt-10 p-6 rounded-lg shadow-lg">
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
                    @foreach ($semuaPengguna as $pengguna)
                    <tr class="border border-[#A67C52]">
                        <td class="py-3">{{ $loop->iteration }}</td>
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