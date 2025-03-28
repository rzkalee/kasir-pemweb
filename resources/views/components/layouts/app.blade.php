<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
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
<body class=" text-white p-6 bg-[#4E2A1D]">
    <div id="app">
        <!-- Navbar -->
        <nav class="fixed top-0 left-0 w-full bg-[#5C3A2C] bg-opacity-80 backdrop-blur-md p-4 flex justify-between items-center shadow-md z-50">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold pl-6 text-[#C5A787]"><a href="{{ route('home') }}">DEWATA ETHNIC</a></h1>
                <ul class="flex items-center space-x-5 ml-auto">
                    @guest
                        @if (Route::has('login'))
                            <li>
                                <a href="{{ route('login') }}" class="nav-link relative text-[#C5A787] after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-[#AC8764] after:transition-all after:duration-300 hover:after:w-full">
                                    L O G I N
                                </a>
                            </li>
                        @endif
                    @else
                        <!-- Navigasi Berdasarkan Peran -->
                        <li>
                            <a href="{{ route('home') }}" class="nav-link relative text-[#C5A787] after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-[#AC8764] after:transition-all after:duration-300 hover:after:w-full">
                                BERANDA
                            </a>
                        </li>

                        @if (Auth::user()->role === 'admin')
                            <li>
                                <a href="{{ route('user') }}" class="nav-link relative text-[#C5A787] after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-[#AC8764] after:transition-all after:duration-300 hover:after:w-full">
                                    PENGGUNA
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('produk') }}" class="nav-link relative text-[#C5A787] after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-[#AC8764] after:transition-all after:duration-300 hover:after:w-full">
                                    PRODUK
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role === 'kasir')
                            <li>
                                <a href="{{ route('transaksi') }}" class="nav-link relative text-[#C5A787] after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-[#AC8764] after:transition-all after:duration-300 hover:after:w-full">
                                    TRANSAKSI
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ route('laporan') }}" class="nav-link relative text-[#C5A787] after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-[#AC8764] after:transition-all after:duration-300 hover:after:w-full">
                                LAPORAN
                            </a>
                        </li>

                        <li class="relative">
                            <button id="dropdown-btn" class="nav-link relative text-[#C5A787] uppercase border border-[#AC8764] px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-[#AC8764]/20 transition-all duration-300">
                                @if (Auth::user()->role == 'admin')
                                    <!-- Ikon Admin -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#C5A787]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 3h18v18H3z"></path>
                                        <path d="M9 9h6v6H9z"></path>
                                    </svg>
                                @elseif (Auth::user()->role == 'kasir')
                                    <!-- Ikon Kasir -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#C5A787]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 4h16v16H4z"></path>
                                        <path d="M8 8h8v8H8z"></path>
                                    </svg>
                                @elseif (Auth::user()->role == 'manager')
                                    <!-- Ikon Manager -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#C5A787]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="8" r="4"></circle>
                                        <path d="M4 20a8 8 0 0 1 16 0"></path>
                                    </svg>
                                @else
                                    <!-- Ikon Default -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#C5A787]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path d="M12 16v-4m0-4h.01"></path>
                                    </svg>
                                @endif
                            
                                {{ Auth::user()->name }}
                            </button>                                                                                
                            <div id="dropdown-menu" class="absolute right-0 mt-2 bg-[#5C3A2C] border border-[#A67C52] rounded-lg shadow-lg hidden">
                                <a href="{{ route('logout') }}" 
                                   class="block px-4 py-2 text-white hover:bg-[#A67C52]"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </li>                                        
                    @endguest
                </ul>
            </div>
        </nav>

        <!-- Main Content (Tambahkan Padding agar Tidak Tertutup Navbar) -->
        <main class="pt-20 pb-8 px-10">
            {{$slot}}
        </main>
    </div>
</body>
</html>

<script>
    const dropdownBtn = document.getElementById('dropdown-btn');
    const dropdownMenu = document.getElementById('dropdown-menu');

    let timeout;

    dropdownBtn.addEventListener('mouseenter', () => {
        clearTimeout(timeout);
        dropdownMenu.classList.remove('hidden');
    });

    dropdownMenu.addEventListener('mouseenter', () => {
        clearTimeout(timeout);
    });

    dropdownMenu.addEventListener('mouseleave', () => {
        timeout = setTimeout(() => {
            dropdownMenu.classList.add('hidden');
        }, 300);
    });

    dropdownBtn.addEventListener('mouseleave', () => {
        timeout = setTimeout(() => {
            dropdownMenu.classList.add('hidden');
        }, 300);
    });
</script>
