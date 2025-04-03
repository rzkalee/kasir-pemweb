<div class="flex items-center justify-between bg-[#5C3A2C] w-full h-[450px] mt-15 px-8 rounded-lg shadow-md overflow-hidden">
    <!-- Bagian Teks -->
    <div class="text-left text-[#C5A787] max-w-lg">
        <div>
           <h1 class="text-2xl italic ">Pripun</h1> 
        </div>
        <h1 class="text-5xl font-bold uppercase tracking-wide drop-shadow-lg">
            {{ Auth::user()->name }}
        </h1>
        <p class="my-8 text-lg font-light">
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

        <a href="#" class="bg-[#C5A787] text-[#301f17] py-3 px-8 rounded-lg" >Beli Sekarang</a>
    </div>

    <!-- Bagian Gambar -->
    <div class="w-1/3 h-full">
        <img src="{{ asset('images/wayang.png') }}" alt="Wayang" class="w-full h-full object-cover object-top">
    </div>
</div>
