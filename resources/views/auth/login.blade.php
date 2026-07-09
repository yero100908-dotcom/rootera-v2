<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Login Admin – ROOTERA</title>
    <meta name="robots" content="noindex,nofollow">
    
    <!-- Modern Tech & Creative Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css'])

    <style>
        /* Modern Editorial Tech & Geometry System */
        .font-display {
            font-family: 'Outfit', sans-serif;
        }
        .font-body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: -0.01em;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ----------------------------------------------------
           ANIMASI PREMIUM: Morphing Organic Liquid Blobs
           (Menciptakan pendaran cairan yang mengalir dinamis di latar belakang)
           ---------------------------------------------------- */
        @keyframes morph-blob-1 {
            0%, 100% { 
                border-radius: 42% 58% 70% 30% / 45% 45% 55% 55%; 
                transform: translate(0px, 0px) rotate(0deg) scale(1); 
            }
            33% { 
                border-radius: 70% 30% 52% 48% / 60% 40% 60% 40%; 
                transform: translate(30px, -40px) rotate(120deg) scale(1.05); 
            }
            66% { 
                border-radius: 50% 50% 30% 70% / 40% 60% 40% 60%; 
                transform: translate(-20px, 20px) rotate(240deg) scale(0.96); 
            }
        }
        .animate-morph-blob-1 {
            animation: morph-blob-1 22s ease-in-out infinite;
        }

        @keyframes morph-blob-2 {
            0%, 100% { 
                border-radius: 70% 30% 52% 48% / 60% 40% 60% 40%; 
                transform: translate(0px, 0px) rotate(0deg) scale(1); 
            }
            50% { 
                border-radius: 42% 58% 70% 30% / 45% 45% 55% 55%; 
                transform: translate(-30px, 30px) rotate(-180deg) scale(0.95); 
            }
        }
        .animate-morph-blob-2 {
            animation: morph-blob-2 26s ease-in-out infinite;
        }

        /* ----------------------------------------------------
           ANIMASI PREMIUM: Flow Pulses (Glow Aliran Pipa)
           ---------------------------------------------------- */
        @keyframes flow-dash-1 {
            0% { stroke-dashoffset: 480; }
            100% { stroke-dashoffset: -480; }
        }
        .animate-flow-pulse-1 {
            animation: flow-dash-1 12s linear infinite;
        }

        @keyframes flow-dash-2 {
            0% { stroke-dashoffset: 600; }
            100% { stroke-dashoffset: -600; }
        }
        .animate-flow-pulse-2 {
            animation: flow-dash-2 16s linear infinite;
        }

        @keyframes float-logo {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-8px) scale(1.02); }
        }
        .animate-float-logo {
            animation: float-logo 6s ease-in-out infinite;
        }

        @keyframes border-shimmer {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-border-shimmer {
            background: linear-gradient(90deg, rgba(22, 159, 129, 0.15), rgba(30, 115, 216, 0.25), rgba(22, 159, 129, 0.15));
            background-size: 200% 200%;
            animation: border-shimmer 8s linear infinite;
        }

        /* Grid Blueprint Sisi Kanan (Premium Subtle Touch) */
        .blueprint-grid-overlay {
            background-image: radial-gradient(circle at 50% 50%, rgba(248, 250, 252, 0.2) 0%, #f8fafc 100%), 
                              url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='44' height='44' viewBox='0 0 44 44'%3E%3Cpath d='M 44 0 L 0 0 0 44' fill='none' stroke='%230a2e78' stroke-opacity='0.03' stroke-width='1'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col lg:flex-row overflow-x-hidden selection:bg-[#169F81]/30 selection:text-[#0A2E78] font-body">
    
    <!-- ================= MAIN CONTAINER: Ultra Responsive Flexbox-Based Layout ================= -->
    <div class="w-full min-h-screen flex flex-col lg:flex-row">
        
        <!-- ================= LEFT COLUMN: Visual Branding & Live Fluid Pipeline Network (Hidden on Mobile & iPad Portrait) ================= -->
        <div class="hidden lg:flex lg:w-[42%] xl:w-[45%] relative flex-col justify-between p-12 xl:p-16 bg-[#03091e] text-white overflow-hidden">
            
            <!-- Dark Deep Background Base Gradient -->
            <div class="absolute inset-0 bg-gradient-to-tr from-[#02091c] via-[#051433] to-[#0A2E78] pointer-events-none"></div>

            <!-- LIVE FLUID MORPHING BLOBS (Pergerakan cairan magis di latar belakang) -->
            <div class="absolute top-12 left-12 w-[500px] h-[500px] bg-gradient-to-tr from-[#169F81]/15 to-transparent blur-[100px] pointer-events-none animate-morph-blob-1"></div>
            <div class="absolute bottom-12 right-12 w-[500px] h-[500px] bg-gradient-to-br from-[#1E73D8]/12 to-transparent blur-[100px] pointer-events-none animate-morph-blob-2"></div>

            <!-- Faint Tech Overlay Grid -->
            <div class="absolute inset-0 bg-[radial-gradient(rgba(255,255,255,0.05)_1px,transparent_1px)] [background-size:20px_20px] opacity-75"></div>

            <!-- ANIMATED PIPELINE NETWORK (Visualisasi aliran pipa sehat) -->
            <div class="absolute inset-0 opacity-25 pointer-events-none">
                <svg class="w-full h-full" viewBox="0 0 800 800" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Faint blueprint pipeline layout -->
                    <path d="M -50 400 C 200 400, 200 180, 420 180 C 640 180, 620 620, 850 620" stroke="rgba(255,255,255,0.08)" stroke-width="2" stroke-linecap="round"/>
                    <path d="M -50 220 C 180 220, 240 580, 450 580 C 660 580, 640 340, 850 340" stroke="rgba(255,255,255,0.08)" stroke-width="2" stroke-linecap="round"/>
                    <path d="M 300 850 V -50" stroke="rgba(255,255,255,0.03)" stroke-width="1.5" stroke-dasharray="10 10"/>
                    
                    <!-- Glowing flow pulses travelling dynamically -->
                    <path d="M -50 400 C 200 400, 200 180, 420 180 C 640 180, 620 620, 850 620" stroke="url(#flowGrad1)" stroke-width="3.5" stroke-linecap="round" stroke-dasharray="100 380" class="animate-flow-pulse-1"/>
                    <path d="M -50 220 C 180 220, 240 580, 450 580 C 660 580, 640 340, 850 340" stroke="url(#flowGrad2)" stroke-width="3.5" stroke-linecap="round" stroke-dasharray="120 480" class="animate-flow-pulse-2"/>
                    
                    <defs>
                        <linearGradient id="flowGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#169F81" stop-opacity="0"/>
                            <stop offset="50%" stop-color="#169F81" stop-opacity="1"/>
                            <stop offset="100%" stop-color="#1dbf9e" stop-opacity="0"/>
                        </linearGradient>
                        <linearGradient id="flowGrad2" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#1E73D8" stop-opacity="0"/>
                            <stop offset="50%" stop-color="#1E73D8" stop-opacity="1"/>
                            <stop offset="100%" stop-color="#169F81" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>

            <!-- Top Header (Back to Home) -->
            <div class="relative z-10">
                <a href="{{ route('home') }}" class="group inline-flex items-center gap-3 px-5 py-2.5 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/25 text-white/90 hover:text-white backdrop-blur-xl transition-all duration-300 text-sm font-semibold tracking-wide">
                    <svg class="w-4.5 h-4.5 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            <!-- Center Content: Branding and Features -->
            <div class="relative z-10 my-auto max-w-xl space-y-16">
                
                <!-- Main Branding Header -->
                <div class="space-y-5">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/Light Mode-Logo.png') }}" class="h-14 w-auto animate-float-logo" alt="ROOTERA Logo" onerror="this.onerror=null; this.style.display='none';">
                        <span class="font-display font-black text-4xl tracking-wider text-white">ROOT<span class="text-[#169F81]">ERA</span></span>
                    </div>
                    <p class="text-white/80 text-xl leading-relaxed font-display font-medium tracking-wide">
                        Solusi Infrastruktur & Pipa Mampet Profesional Nomor #1 di Indonesia.
                    </p>
                </div>

                <!-- Premium Glassmorphic Cards -->
                <div class="space-y-8">
                    
                    <!-- Feature Card 1 -->
                    <div class="group flex gap-6 p-6 rounded-3xl bg-white/[0.03] hover:bg-white/[0.06] border border-white/10 hover:border-white/20 backdrop-blur-xl transition-all duration-300 shadow-2xl shadow-black/10">
                        <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#169F81] to-[#1dbf9e] flex items-center justify-center shadow-lg shadow-[#169F81]/30 transition-transform duration-300 group-hover:scale-110">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-display font-bold text-xl text-white group-hover:text-[#169F81] transition-colors tracking-wide">Sistem Keamanan Berlapis</h4>
                            <p class="text-sm text-white/70 leading-relaxed font-body">Akses panel admin yang dienkripsi ketat untuk melindungi keandalan data dan manajemen operasional Rootera.</p>
                        </div>
                    </div>

                    <!-- Feature Card 2 -->
                    <div class="group flex gap-6 p-6 rounded-3xl bg-white/[0.03] hover:bg-white/[0.06] border border-white/10 hover:border-white/20 backdrop-blur-xl transition-all duration-300 shadow-2xl shadow-black/10">
                        <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#1E73D8] to-[#1a4aa8] flex items-center justify-center shadow-lg shadow-[#1E73D8]/30 transition-transform duration-300 group-hover:scale-110">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-display font-bold text-xl text-white group-hover:text-[#1E73D8] transition-colors tracking-wide">Manajemen Real-Time</h4>
                            <p class="text-sm text-white/70 leading-relaxed font-body">Sinkronisasi data konten, peta cakupan area, layanan harga, serta FAQ terpadu secara langsung dan instan.</p>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Bottom Brand Footnote -->
            <div class="relative z-10 flex items-center justify-between text-xs text-white/40 border-t border-white/10 pt-8 mt-4 font-body">
                <span>&copy; {{ date('Y') }} ROOTERA Team. All rights reserved.</span>
                <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10 font-mono">v2.1.0</span>
            </div>

        </div>


        <!-- ================= RIGHT COLUMN: Fully Responsive Form Container (Optimized for Mobile, iPad, and Desktop) ================= -->
        <div class="w-full lg:w-[58%] xl:w-[55%] min-h-screen flex items-center justify-center p-4 sm:p-8 md:p-12 lg:p-16 bg-[#f8fafc] relative blueprint-grid-overlay">
            
            <!-- Soft Organic Glow Orbs in the background -->
            <div class="absolute top-1/4 right-1/4 w-72 sm:w-96 h-72 sm:h-96 rounded-full bg-[#169F81]/5 blur-[100px] pointer-events-none animate-morph-blob-1"></div>
            <div class="absolute bottom-1/4 left-1/4 w-72 sm:w-96 h-72 sm:h-96 rounded-full bg-[#0A2E78]/5 blur-[100px] pointer-events-none animate-morph-blob-2"></div>

            <!-- Main Content Wrapper with balanced padding so it never squeezes on narrow screens -->
            <div class="w-full max-w-[480px] sm:max-w-[520px] space-y-10 relative z-10 py-6">
                
                <!-- Brand logo and typography (Fully adaptive) -->
                <div class="text-center lg:text-left space-y-4">
                    
                    <!-- Mobile / iPad Branding (Visible only on screens below lg) -->
                    <div class="lg:hidden flex justify-center mb-6">
                        <div class="inline-flex items-center gap-3 px-5 py-3 rounded-[20px] bg-white shadow-lg shadow-slate-200/60 border border-slate-100 animate-float-logo">
                            <img src="{{ asset('images/dark mode-notag.png') }}" class="h-8 w-auto" alt="ROOTERA Logo" onerror="this.onerror=null; this.style.display='none';">
                            <span class="font-display font-extrabold text-2xl tracking-wide text-[#0A2E78]">ROOT<span class="text-[#169F81]">ERA</span></span>
                        </div>
                    </div>

                    <!-- Welcome Headers (Large, bold, premium) -->
                    <h2 class="font-display font-black text-3.5xl sm:text-4.5xl md:text-5xl text-[#0A2E78] tracking-tight leading-none">
                        Selamat Datang
                    </h2>
                    <p class="text-sm sm:text-base md:text-lg text-slate-500 font-medium font-body leading-relaxed max-w-md mx-auto lg:mx-0">
                        Silakan masukkan akun Anda untuk mengakses Portal Administrasi.
                    </p>
                </div>

                <!-- Alert Error Box (Elegant, High-Contrast design) -->
                @if($errors->any())
                <div class="p-5 rounded-3xl bg-red-50 border border-red-200 flex gap-4 items-start text-red-900 shadow-sm">
                    <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="text-sm font-body space-y-0.5">
                        <span class="font-display font-bold text-red-800 text-base block leading-none">Kredensial Tidak Cocok</span>
                        <p class="text-red-600 font-medium leading-relaxed mt-1">{{ $errors->first() }}</p>
                    </div>
                </div>
                @endif

                <!-- Form Card wrapper (Ultra Responsive with dynamic Padding and Double-Layer Border Glow) -->
                <div class="relative group">
                    
                    <!-- Card Border Shimmer Glow Backing (Smooth, dynamic) -->
                    <div class="absolute -inset-1.5 animate-border-shimmer rounded-[30px] sm:rounded-[38px] blur-2xl opacity-60 group-hover:opacity-85 transition duration-1000 pointer-events-none"></div>
                    
                    <!-- Main Card Container (p-6 on mobile, p-10 on sm, p-12 on md/lg for max breathability) -->
                    <div class="relative bg-white p-6 sm:p-10 md:p-12 rounded-[28px] sm:rounded-[36px] border border-slate-100 shadow-2xl shadow-slate-200/40">
                        
                        <form action="/login" method="POST" class="space-y-7 sm:space-y-8">
                            @csrf
                            
                            <!-- Input Email Field -->
                            <div class="space-y-3">
                                <label for="email" class="font-display font-extrabold text-xs sm:text-sm text-[#0A2E78] uppercase tracking-wider block">
                                    Alamat Email / Username
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-[#169F81] transition-colors duration-200">
                                        <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/>
                                        </svg>
                                    </div>
                                    <!-- Using text-base (16px) for input to completely prevent iOS auto-zoom bug -->
                                    <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        placeholder="admin@rootera.id" 
                                        required 
                                        autofocus
                                        class="w-full pl-13 pr-5 py-4 bg-slate-50/60 border border-slate-200 focus:bg-white focus:border-[#169F81] focus:ring-4 focus:ring-[#169F81]/10 rounded-2xl focus:outline-none text-slate-800 placeholder-slate-400 text-base font-semibold transition-all duration-300 font-body"
                                    >
                                </div>
                            </div>

                            <!-- Input Password Field -->
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <label for="password" class="font-display font-extrabold text-xs sm:text-sm text-[#0A2E78] uppercase tracking-wider block">
                                        Kata Sandi
                                    </label>
                                </div>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-[#169F81] transition-colors duration-200">
                                        <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <!-- Using text-base (16px) to prevent iOS auto-zoom -->
                                    <input 
                                        type="password" 
                                        id="password" 
                                        name="password" 
                                        placeholder="••••••••" 
                                        required
                                        class="w-full pl-13 pr-14 py-4 bg-slate-50/60 border border-slate-200 focus:bg-white focus:border-[#169F81] focus:ring-4 focus:ring-[#169F81]/10 rounded-2xl focus:outline-none text-slate-800 placeholder-slate-400 text-base font-semibold transition-all duration-300 font-body"
                                    >
                                    <!-- Eye Password Toggle Button -->
                                    <button 
                                        type="button" 
                                        onclick="togglePasswordVisibility()" 
                                        class="absolute inset-y-0 right-0 pr-5 flex items-center text-slate-400 hover:text-[#169F81] focus:outline-none transition-colors"
                                        title="Tampilkan kata sandi"
                                    >
                                        <svg id="eye-icon" class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path id="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path id="eye-body" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            <!-- Eye slash path (hidden by default) -->
                                            <path id="eye-slash" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.024 10.024 0 012.302-3.875M9.172 9.172a4 4 0 015.656 5.656M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Remember Me Option (Fully stackable on mobile, horizontal on tablet/desktop) -->
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 py-1">
                                <label class="flex items-center gap-3 cursor-pointer group select-none">
                                    <input 
                                        type="checkbox" 
                                        id="remember" 
                                        name="remember" 
                                        class="peer h-5 w-5 rounded border-slate-300 text-[#169F81] focus:ring-[#169F81]/25 accent-[#169F81] transition-all cursor-pointer"
                                    >
                                    <span class="text-sm font-bold text-slate-500 group-hover:text-slate-700 transition-colors font-body">
                                        Ingat saya di perangkat ini
                                    </span>
                                </label>
                            </div>

                            <!-- Submit Button (Large touch target, grand gradient) -->
                            <div class="pt-2">
                                <button 
                                    type="submit" 
                                    class="w-full py-4.5 px-8 rounded-2xl text-white font-display font-bold text-base bg-gradient-to-r from-[#169F81] to-[#107F66] hover:from-[#1dbf9e] hover:to-[#169F81] focus:ring-4 focus:ring-[#169F81]/25 transition-all duration-300 transform active:scale-[0.98] shadow-xl shadow-[#169F81]/25 flex items-center justify-center gap-3 cursor-pointer"
                                >
                                    <span>Masuk ke Admin Panel</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </button>
                            </div>

                        </form>
                        
                    </div>
                </div>

                <!-- Footer back link (Comfortably separated) -->
                <p class="text-center pt-2">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 text-sm sm:text-base text-[#0A2E78] hover:text-[#169F81] transition-colors group font-display font-bold tracking-wide">
                        <svg class="w-4.5 h-4.5 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Website Utama
                    </a>
                </p>

            </div>

        </div>

    </div>

    <!-- Password visibility toggle script -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeBody = document.getElementById('eye-body');
            const eyeSlash = document.getElementById('eye-slash');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Hide normal eye, show slashed eye
                eyeOpen.classList.add('hidden');
                eyeBody.classList.add('hidden');
                eyeSlash.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                // Show normal eye, hide slashed eye
                eyeOpen.classList.remove('hidden');
                eyeBody.classList.remove('hidden');
                eyeSlash.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
