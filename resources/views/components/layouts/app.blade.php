<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Girassol&display=swap" rel="stylesheet">

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

                        <!-- Dropdown Profil & Logout -->
                        <li class="relative group">
                            <button class="nav-link relative text-[#C5A787] after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-[#AC8764] after:transition-all after:duration-300 hover:after:w-full">
                                {{ Auth::user()->name }}
                            </button>
                            <div class="absolute right-0 mt-2 bg-[#5C3A2C] border border-[#A67C52] rounded-lg shadow-lg hidden group-hover:block">
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
        <main class="pt-20 pb-8">
            {{$slot}}
        </main>
    </div>
</body>
</html>
