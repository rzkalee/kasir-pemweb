<div>
    <!-- Hero Section -->
    <div class="flex flex-wrap items-center justify-between bg-[#5C3A2C] w-full h-[450px] px-8 rounded-lg shadow-md overflow-hidden">
        <!-- Bagian Teks -->
        <div class="text-left text-[#C5A787] max-w-lg space-y-6">
            <h1 class="text-2xl italic">Pripun</h1>
            <h1 class="text-5xl font-bold uppercase tracking-wide drop-shadow-lg">
                {{ Auth::user()->name }}
            </h1>
            <p class="text-lg font-light">
                @if (auth()->user()->role == 'admin')
                    "Anda adalah otak di balik kesuksesan toko ini! Kelola bisnis dengan cermat, pantau transaksi, dan pastikan segalanya berjalan lancar. Keberhasilan ada di tangan Anda!"
                @elseif (auth()->user()->role == 'kasir')
                    "Setiap transaksi yang Anda lakukan adalah langkah menuju kepuasan pelanggan! Tetap semangat, layani dengan senyum, dan jadilah bagian dari pengalaman belanja yang luar biasa!"
                @elseif (auth()->user()->role == 'manager')
                    "Sebagai pemimpin, Anda mengarahkan jalan menuju kesuksesan! Analisis, rencanakan, dan buat keputusan terbaik untuk membawa bisnis ini ke level yang lebih tinggi!"
                @else
                    "Batik adalah warisan budaya yang hidup dalam setiap helai kain. Temukan keindahannya dan jadilah bagian dari perjalanan melestarikan tradisi dengan gaya modern!"
                @endif
            </p>
        </div>

        <!-- Bagian Gambar -->
        <div class="w-full md:w-1/3 mt-8 md:mt-0 h-[300px] md:h-full">
            <img src="{{ asset('images/wayang.png') }}" alt="Wayang" class="w-full h-full object-cover object-top rounded-lg">
        </div>
    </div>

    <!-- Informasi Box -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        @if (auth()->user()->role == 'admin')
            <!-- Total User -->
            <div class="bg-[#5C3A2C] rounded-2xl p-6 shadow-lg text-white flex items-center space-x-4">
                <div class="text-[#C5A787]">
                    <!-- Icon User -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M4 20h5v-2a4 4 0 00-3-3.87M15 11a4 4 0 10-8 0 4 4 0 008 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Total User</h3>
                    <p class="text-3xl font-bold text-[#C5A787]">{{ $data['totalUser'] }}</p>
                </div>
            </div>
    
            <!-- Total Produk -->
            <div class="bg-[#5C3A2C] rounded-2xl p-6 shadow-lg text-white flex items-center space-x-4">
                <div class="text-[#C5A787]">
                    <!-- Icon Box -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4M3 7v10l9 4 9-4V7M3 17l9 4 9-4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Total Produk</h3>
                    <p class="text-3xl font-bold text-[#C5A787]">{{ $data['totalProduk'] }}</p>
                </div>
            </div>
    
            <!-- Total Stok -->
            <div class="bg-[#5C3A2C] rounded-2xl p-6 shadow-lg text-white flex items-center space-x-4">
                <div class="text-[#C5A787]">
                    <!-- Icon Layers -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4l8 4-8 4-8-4 8-4zM4 12l8 4 8-4M4 16l8 4 8-4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Total Stok Produk</h3>
                    <p class="text-3xl font-bold text-[#C5A787]">{{ $data['totalStok'] }}</p>
                </div>
            </div>
    
        @elseif (auth()->user()->role == 'kasir')
            <!-- Transaksi Hari Ini -->
            <div class="bg-[#5C3A2C] rounded-2xl p-6 shadow-lg text-white flex items-center space-x-4">
                <div class="text-[#C5A787]">
                    <!-- Icon Receipt -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M9 14h6M9 10h6M4 4h16v16H4z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Transaksi Hari Ini</h3>
                    <p class="text-3xl font-bold text-[#C5A787]">{{ $data['jumlahTransaksi'] }}</p>
                </div>
            </div>
    
            <!-- Produk Terjual -->
            <div class="bg-[#5C3A2C] rounded-2xl p-6 shadow-lg text-white flex items-center space-x-4">
                <div class="text-[#C5A787]">
                    <!-- Icon Shopping Bag -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M6 2l1 4h10l1-4M5 6h14l1 14H4L5 6zM9 10v4M15 10v4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Produk Terjual Hari Ini</h3>
                    <p class="text-3xl font-bold text-[#C5A787]">{{ $data['produkTerjual'] }}</p>
                </div>
            </div>
    
            <!-- Pemasukan Hari Ini -->
            <div class="bg-[#5C3A2C] rounded-2xl p-6 shadow-lg text-white flex items-center space-x-4">
                <div class="text-[#C5A787]">
                    <!-- Icon Wallet -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M21 12v-2a2 2 0 00-2-2H5V6h14a2 2 0 012 2v4M3 10v10a2 2 0 002 2h14a2 2 0 002-2V10H3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Total Pemasukan Hari Ini</h3>
                    <p class="text-3xl font-bold text-[#C5A787]">Rp {{ number_format($data['pemasukanHariIni'], 0, ',', '.') }}</p>
                </div>
            </div>
    
        @elseif (auth()->user()->role == 'manager')
            <!-- Transaksi Bulan Ini -->
            <div class="bg-[#5C3A2C] rounded-2xl p-6 shadow-lg text-white flex items-center space-x-4">
                <div class="text-[#C5A787]">
                    <!-- Icon Calendar -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M8 7V3M16 7V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Transaksi Bulan Ini</h3>
                    <p class="text-3xl font-bold text-[#C5A787]">{{ $data['jumlahTransaksi'] }}</p>
                </div>
            </div>
    
            <!-- Produk Terjual Bulan Ini -->
            <div class="bg-[#5C3A2C] rounded-2xl p-6 shadow-lg text-white flex items-center space-x-4">
                <div class="text-[#C5A787]">
                    <!-- Icon Cart -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5H3M7 13l-1.5 7h13L17 13M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Produk Terjual Bulan Ini</h3>
                    <p class="text-3xl font-bold text-[#C5A787]">{{ $data['produkTerjual'] }}</p>
                </div>
            </div>
    
            <!-- Pemasukan Bulan Ini -->
            <div class="bg-[#5C3A2C] rounded-2xl p-6 shadow-lg text-white flex items-center space-x-4">
                <div class="text-[#C5A787]">
                    <!-- Icon Money -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-1">Total Pemasukan Bulan Ini</h3>
                    <p class="text-3xl font-bold text-[#C5A787]">Rp {{ number_format($data['pemasukanBulanIni'], 0, ',', '.') }}</p>
                </div>
            </div>
        @endif
    </div>    
</div>
