<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dewata Ethnic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        h1 {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="min-h-screen text-white flex flex-col items-center p-6 bg-[#4E2A1D]">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full bg-[#5C3A2C] bg-opacity-80 backdrop-blur-md p-4 flex justify-between items-center shadow-md z-50">
        <h1 class="text-2xl font-bold pl-6 text-[#C5A787]">DEWATA ETHNIC</h1>
        <ul class="flex space-x-6 pr-6">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link relative text-[#C5A787] after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-[#AC8764] after:transition-all after:duration-300 hover:after:w-full" href="{{ route('login') }}">
                            L O G I N
                        </a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #6f4c3e;">
                        {{ Auth::user()->name }}
                    </a>
        
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                L O G O U T
                        </a>
        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>             
    </nav>

    <header class="flex items-center justify-between bg-[#5C3A2C] w-full h-[450px] mt-20 px-10 rounded-lg shadow-md overflow-hidden">
        <!-- Bagian Teks -->
        <div class="text-left text-[#C5A787] max-w-lg">
            <div>
               <h1 class="text-2xl italic ">Sugeng rawuh ing</h1> 
            </div>
            <h1 class="text-5xl font-bold tracking-wide drop-shadow-lg">
                DEWATA ETHNIC
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
    </header>
    
    <!-- Pilihan Produk -->
    <section id="produk" class="mt-16 max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-10 mx-auto px-4">
        <div class="bg-[#A67C52] p-6 rounded-2xl text-center border border-[#6D4C41] max-w-xs mx-auto transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
          <div class="w-full aspect-[3/4] mb-4 overflow-hidden rounded-xl">
            <img src="{{ asset('images/batiktradisional.jpg') }}" alt="Batik Tradisional"
              class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
          </div>
          <h1 class="text-xl font-semibold text-white" style="font-family: 'Playfair Display', serif;">Batik Tradisional</h1>
          <p class="text-sm mt-2 text-white">Keindahan klasik yang tak lekang oleh waktu.</p>
        </div>
      
        <div class="bg-[#A67C52] p-6 rounded-2xl text-center border border-[#6D4C41] max-w-xs mx-auto transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
          <div class="w-full aspect-[3/4] mb-4 overflow-hidden rounded-xl">
            <img src="{{ asset('images/batikmodern1.jpg') }}" alt="Batik Modern"
              class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
          </div>
          <h1 class="text-xl font-semibold text-white" style="font-family: 'Playfair Display', serif;">Batik Modern</h1>
          <p class="text-sm mt-2 text-white">Keindahan klasik yang tak lekang oleh waktu.</p>
        </div>
      </section>        

    <!-- Keunggulan -->
    <section id="keunggulan" class="w-full h-fit mt-20 text-center bg-[#4B2E1C] p-10 rounded-3xl border border-[#A67C52] text-white shadow-2xl">
        <h2 class="text-4xl md:text-5xl font-bold mb-6 tracking-wide text-[#F5E9DC]" style="font-family: 'Playfair Display', serif;">
          Keunggulan Kami
        </h2>
        <p class="text-lg md:text-xl font-light mb-12 text-[#f1e7df] max-w-2xl mx-auto italic">
          Menghadirkan batik berkualitas tinggi dengan desain unik dan bahan terbaik.
        </p>
      
        <ul class="text-left max-w-3xl mx-auto space-y-6 text-base font-light text-[#fdf9f5]">
          <li class="group flex gap-3 items-start border-l-4 border-[#A67C52] pl-4">
            <span class="transition-transform duration-300 group-hover:translate-x-2">
              <strong class="font-semibold">Kualitas Premium</strong> – Bahan pilihan yang nyaman, awet, dan ramah di kulit.
            </span>
          </li>
          <li class="group flex gap-3 items-start border-l-4 border-[#A67C52] pl-4">
            <span class="transition-transform duration-300 group-hover:translate-x-2">
              <strong class="font-semibold">Motif Eksklusif & Unik</strong> – Desain tidak pasaran, penuh makna dan estetika budaya.
            </span>
          </li>
          <li class="group flex gap-3 items-start border-l-4 border-[#A67C52] pl-4">
            <span class="transition-transform duration-300 group-hover:translate-x-2">
              <strong class="font-semibold">100% Handmade</strong> – Dikerjakan langsung oleh pengrajin batik berpengalaman.
            </span>
          </li>
          <li class="group flex gap-3 items-start border-l-4 border-[#A67C52] pl-4">
            <span class="transition-transform duration-300 group-hover:translate-x-2">
              <strong class="font-semibold">Dukung UMKM Lokal</strong> – Ikut menghidupkan perajin batik lokal.
            </span>
          </li>
          <li class="group flex gap-3 items-start border-l-4 border-[#A67C52] pl-4">
            <span class="transition-transform duration-300 group-hover:translate-x-2">
              <strong class="font-semibold">Ramah Lingkungan</strong> – Pewarna alami & proses produksi berkelanjutan.
            </span>
          </li>
          <li class="group flex gap-3 items-start border-l-4 border-[#A67C52] pl-4">
            <span class="transition-transform duration-300 group-hover:translate-x-2">
              <strong class="font-semibold">Kemasan Eksklusif</strong> – Rapi, menarik, cocok untuk koleksi atau hadiah.
            </span>
          </li>
          <li class="group flex gap-3 items-start border-l-4 border-[#A67C52] pl-4">
            <span class="transition-transform duration-300 group-hover:translate-x-2">
              <strong class="font-semibold">Bisa Custom</strong> – Tersedia desain & ukuran sesuai permintaan Anda.
            </span>
          </li>
        </ul>
      </section>
      
    <!-- Informasi Lokasi dan Kontak -->
    <section id="lokasi" class="mt-16 text-center max-w-3xl bg-[#8B5E3C] p-8 rounded-lg border border-[#A67C52]">
        <h2 class="text-3xl font-bold">Lokasi & Kontak</h2>
        <p class="mt-4 text-lg font-light">Alamat: Jl. Batik Indah No. 10, Yogyakarta</p>
        <p class="mt-2 text-lg font-light">Telepon: +62 812-3456-7890</p>
        <p class="mt-2 text-lg font-light">Email: info@batikelegan.com</p>
    </section>
</body>
</html>