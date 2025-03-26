<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Batik Elegan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Playfair Display', serif;
            background: linear-gradient(135deg, #4E2A1D, #A67C52);
        }
        p, label, input, button {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

    <!-- Login Container -->
    <div class="bg-[#5C3A2C] text-white p-8 rounded-lg shadow-lg w-full max-w-md border border-[#A67C52]">
        <h2 class="text-3xl font-bold text-center mb-6">Login</h2>

        <!-- Form Login Laravel -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                    class="w-full mt-1 p-3 rounded-lg bg-[#A67C52] text-white border border-[#8B5E3C] focus:outline-none focus:ring-2 focus:ring-[#6D4C41] placeholder-white @error('email') border-red-500 @enderror" 
                    placeholder="Masukkan email">
                
                @error('email')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold">Password</label>
                <input type="password" id="password" name="password" required 
                    class="w-full mt-1 p-3 rounded-lg bg-[#A67C52] text-white border border-[#8B5E3C] focus:outline-none focus:ring-2 focus:ring-[#6D4C41] placeholder-white @error('password') border-red-500 @enderror" 
                    placeholder="Masukkan password">
                
                @error('password')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2 text-[#A67C52] border border-[#8B5E3C]" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="text-sm">Ingat saya</label>
            </div>

            <!-- Tombol Login -->
            <button type="submit" class="w-full bg-[#8B5E3C] text-white font-semibold p-3 rounded-lg hover:bg-[#6D4C41] transition">
                Login
            </button>

            <!-- Lupa Password -->
            @if (Route::has('password.request'))
                <p class="text-center mt-3">
                    <a href="{{ route('password.request') }}" class="text-[#A67C52] font-semibold hover:underline">
                        Lupa Password?
                    </a>
                </p>
            @endif
        </form>
    </div>

</body>
</html>
