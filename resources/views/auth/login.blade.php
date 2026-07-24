<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Login Admin – Rooterin</title>
    <meta name="robots" content="noindex,nofollow">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col items-center justify-center p-4 sm:p-6 relative overflow-hidden">

    <!-- Soft Background Orbs -->
    <div class="absolute top-[5%] left-[5%] md:top-[-10%] md:left-[-10%] w-64 md:w-96 h-64 md:h-96 bg-[#169F81]/10 rounded-full blur-[80px] md:blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-[5%] right-[5%] md:bottom-[-10%] md:right-[-10%] w-64 md:w-96 h-64 md:h-96 bg-[#0A2E78]/10 rounded-full blur-[80px] md:blur-[100px] pointer-events-none"></div>

    <!-- Login Container -->
    <div class="w-full max-w-[420px] relative z-10">
        
        <!-- Login Card -->
        <div class="bg-white/95 backdrop-blur-xl rounded-[24px] shadow-xl border border-white p-8 sm:p-10">
            
            <!-- Header Card -->
            <div class="flex flex-col items-center mb-8">
                <!-- Logo Wrapper to handle transparent padding -->
                <div class="relative w-full h-24 sm:h-28 flex items-center justify-center mb-2 sm:mb-4">
                    <img src="{{ asset('images/Light Mode-Logo.png') }}" class="absolute h-48 sm:h-56 w-auto object-contain drop-shadow-sm pointer-events-none" alt="Rooterin Logo" onerror="this.onerror=null; this.src='{{ asset('images/dark mode-notag.png') }}';">
                </div>
                
                <!-- Title -->
                <h1 class="text-[24px] sm:text-[26px] font-bold text-[#0A2E78] leading-tight text-center">Selamat Datang</h1>
                
                <!-- Sub-title -->
                <p class="text-slate-500 text-[14px] text-center mt-2.5 leading-relaxed">
                    Silakan masukkan akun Anda untuk mengakses Portal Administrasi.
                </p>
            </div>

            <!-- Error Box -->
            @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-600 text-[13px] font-medium border border-red-100 flex items-start gap-3">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            <!-- Form -->
            <form action="/login" method="POST" class="space-y-5">
                @csrf
                
                <!-- Input 1: Email / Username -->
                <div class="space-y-2">
                    <label for="email" class="block text-[12px] font-bold text-[#0A2E78] uppercase tracking-wide">
                        Alamat Email / Username
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@Rooterin.id" required autofocus
                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-[#169F81] focus:ring-2 focus:ring-[#169F81]/20 outline-none transition-all text-slate-800 text-[14px] sm:text-[15px] placeholder:text-slate-400">
                </div>

                <!-- Input 2: Kata Sandi -->
                <div class="space-y-2 relative">
                    <label for="password" class="block text-[12px] font-bold text-[#0A2E78] uppercase tracking-wide">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                            class="w-full pl-4 pr-12 py-3.5 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-[#169F81] focus:ring-2 focus:ring-[#169F81]/20 outline-none transition-all text-slate-800 text-[14px] sm:text-[15px] placeholder:text-slate-400">
                        <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#169F81] transition-colors focus:outline-none" title="Tampilkan/Sembunyikan Sandi">
                            <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path id="eye-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Checkbox: Ingat saya -->
                <div class="flex items-center pt-1">
                    <label class="flex items-center gap-2.5 cursor-pointer group select-none">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-slate-300 text-[#169F81] focus:ring-[#169F81] focus:ring-offset-0 transition-all cursor-pointer">
                        <span class="text-[13px] font-medium text-slate-500 group-hover:text-slate-800 transition-colors">
                            Ingat saya di perangkat ini
                        </span>
                    </label>
                </div>

                <!-- Tombol Login -->
                <div class="pt-3">
                    <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-[#169F81] hover:bg-[#138a70] text-white font-bold text-[15px] transition-all duration-300 shadow-lg shadow-[#169F81]/25 active:scale-[0.98] flex items-center justify-center gap-2">
                        <span>Masuk</span>
                    </button>
                </div>
            </form>
            
        </div>

        <!-- Footer Card -->
        <div class="mt-8 flex justify-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 text-[13px] sm:text-[14px] font-semibold text-[#0A2E78] hover:text-[#169F81] transition-colors group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Website Utama
            </a>
        </div>

    </div>

    <!-- Script for Password Toggle -->
    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            const eyePath = document.getElementById('eye-path');
            if(pwd.type === 'password') {
                pwd.type = 'text';
                eyePath.setAttribute('d', 'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.024 10.024 0 012.302-3.875M9.172 9.172a4 4 0 015.656 5.656M3 3l18 18');
            } else {
                pwd.type = 'password';
                eyePath.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z');
            }
        }
    </script>
</body>
</html>
