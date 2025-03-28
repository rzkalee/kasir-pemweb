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
            Jelajahi koleksi batik eksklusif kami yang memadukan tradisi dan modernitas dalam satu harmoni.
        </p>

        <a href="#" class="bg-[#C5A787] text-[#301f17] py-3 px-8 rounded-lg" >Beli Sekarang</a>
    </div>

    <!-- Bagian Gambar -->
    <div class="w-1/3 h-full">
        <img src="{{ asset('images/wayang.png') }}" alt="Wayang" class="w-full h-full object-cover object-top">
    </div>
</div>
