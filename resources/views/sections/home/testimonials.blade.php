<style>
    @keyframes marquee-scroll-left {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .marquee-track {
        display: flex;
        width: max-content;
        animation: marquee-scroll-left 40s linear infinite;
        will-change: transform;
    }
    .marquee-track:hover {
        animation-play-state: paused;
    }
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<section id="ulasan-pelanggan" class="w-full relative py-16 sm:py-24 overflow-hidden scroll-margin-top-[100px]" style="background-color: #0f172a; background-image: radial-gradient(circle at 10% 20%, rgba(16, 185, 129, 0.06) 0%, transparent 40%), radial-gradient(circle at 90% 80%, rgba(10, 46, 120, 0.2) 0%, transparent 50%), linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px); background-size: 100% 100%, 100% 100%, 24px 24px, 24px 24px;">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-emerald-500/10 text-[#10b981] border border-emerald-500/20 text-xs font-semibold uppercase tracking-wider mb-4">
                ⭐ ULASAN CUSTOMERS
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
                Apa Kata Pelanggan Kami?
            </h2>
        </div>

        <!-- Map & Rating Container -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16 max-w-7xl mx-auto">
            
            <!-- 1. BAGIAN PETA (KIRI) -->
            <div class="relative bg-slate-800 rounded-3xl overflow-hidden shadow-xl shadow-emerald-900/20 border border-slate-700 min-h-[300px] lg:min-h-[100%] h-full group">
                <!-- Iframe murni tanpa library React -->
                <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=Rootera+Plumbing+Jakarta&t=&z=14&ie=UTF8&iwloc=&output=embed" style="border-radius: 12px; min-height: 250px; display: block;"></iframe>
                
                <!-- Tombol Buka di Google Maps Absolute Positioning -->
                <div class="absolute bottom-4 left-4 right-4 flex justify-center pointer-events-none">
                    <a href="https://maps.app.goo.gl/4kAgQHxg6XXvnV3Z7" target="_blank" rel="noopener noreferrer" class="pointer-events-auto flex items-center gap-2 px-5 py-2.5 bg-white text-slate-900 text-sm font-bold rounded-full shadow-lg hover:scale-105 transition-transform duration-300">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        Buka di Google Maps
                    </a>
                </div>
            </div>

            <!-- 2. BAGIAN RATING (KANAN) -->
            <div class="bg-slate-800 border border-slate-700 rounded-3xl p-6 sm:p-8 shadow-xl flex flex-col justify-center h-full text-white relative overflow-hidden">
                <!-- Loader Overlay (Client Component State: isLoading) -->
                <div id="rating-loader" class="absolute inset-0 bg-slate-800 z-10 flex flex-col items-center justify-center">
                    <svg class="animate-spin w-8 h-8 text-emerald-500 mb-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </div>
                
                <!-- Client Component State: data -->
                <div class="flex flex-col md:flex-row items-center justify-between gap-10 md:gap-8 w-full h-full opacity-0 transition-opacity duration-500" id="rating-content">
                    <div class="w-full md:w-1/2 text-center md:text-left flex flex-col items-center md:items-start justify-center gap-2">
                        <div class="flex items-center gap-2 justify-center md:justify-start">
                            <span class="text-5xl font-black text-white" id="dynamic-rating-score">5.0</span>
                            <span class="text-lg font-bold text-slate-400">/ 5.0</span>
                        </div>
                        <div class="flex gap-1 text-amber-400 text-2xl font-bold my-1" id="dynamic-rating-stars">
                            ★ ★ ★ ★ ★
                        </div>
                        <p class="text-sm font-semibold text-slate-400" id="dynamic-rating-total">Berdasarkan Ulasan Google Maps</p>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-bold mt-2 border border-emerald-500/30">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><path d="m9 12 2 2 4-4"/></svg>
                            Ulasan Terverifikasi Google
                        </span>
                    </div>

                    <div class="w-full md:w-1/2 flex flex-col justify-center gap-3 w-full" id="rating-breakdown-container">
                        <!-- Rating Breakdown Bars Injected by JS -->
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. BAGIAN ULASAN (BAWAH) - Marquee Carousel -->
        <div class="relative w-full overflow-hidden mb-12">
            <!-- Fade Gradient Masks for Dark Theme -->
            <div class="pointer-events-none absolute inset-y-0 left-0 w-16 sm:w-32 bg-gradient-to-r from-[#0f172a] to-transparent z-10" aria-hidden="true"></div>
            <div class="pointer-events-none absolute inset-y-0 right-0 w-16 sm:w-32 bg-gradient-to-l from-[#0f172a] to-transparent z-10" aria-hidden="true"></div>

            <!-- Loader for Reviews (Client Component State: isLoading) -->
            <div id="reviews-loader" class="flex justify-center py-10 w-full absolute z-20 transition-opacity duration-300">
                <div class="animate-pulse flex gap-6 w-max overflow-hidden px-10">
                    <div class="w-[310px] h-[260px] bg-slate-800 rounded-2xl"></div>
                    <div class="w-[310px] h-[260px] bg-slate-800 rounded-2xl"></div>
                    <div class="w-[310px] h-[260px] bg-slate-800 rounded-2xl"></div>
                </div>
            </div>

            <!-- Marquee Track (Client Component State: data) -->
            <div class="marquee-track gap-6 py-4 opacity-0 transition-opacity duration-500" id="reviews-marquee-track">
                <!-- Javascript will inject real/fallback review cards here -->
            </div>
        </div>

        <!-- 3. STRUKTUR & DESAIN TAMBAHAN (Call To Action) -->
        <div class="text-center mt-4">
            <a href="https://maps.app.goo.gl/4kAgQHxg6XXvnV3Z7" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-full transition-all duration-300 shadow-lg shadow-emerald-500/25 transform hover:-translate-y-0.5 cursor-pointer">
                <span>Lihat Seluruh Ulasan Kami di Google</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
        </div>

    </div>
</section>

<!-- Frontend Client Component Logic (Fetch & State Management) -->
<script>
document.addEventListener('DOMContentLoaded', function() {

    function renderRatingCard(stats) {
        document.getElementById('dynamic-rating-score').textContent = stats.rating ? stats.rating.toFixed(1) : '5.0';
        
        let starsHtml = '';
        const fullStars = Math.floor(stats.rating || 5);
        for(let i=0; i<5; i++) {
            starsHtml += i < fullStars ? '★ ' : '☆ ';
        }
        document.getElementById('dynamic-rating-stars').textContent = starsHtml.trim();

        let breakdownHtml = '';
        // If breakdown is not provided natively by API, create a proportional bar UI
        let bd = {
            5: Math.floor((stats.user_ratings_total || 11) * 0.95),
            4: Math.floor((stats.user_ratings_total || 11) * 0.05),
            3: 0, 2: 0, 1: 0
        };

        for(let i=5; i>=1; i--) {
            let count = bd[i];
            let total = stats.user_ratings_total || 11;
            let percentage = total > 0 ? (count / total) * 100 : 0;
            breakdownHtml += `
            <div class="flex items-center gap-3 text-sm ${percentage === 0 ? 'opacity-50' : ''}">
                <span class="w-2 text-slate-400 font-bold">${i}</span>
                <span class="text-amber-400 text-xs">★</span>
                <div class="flex-1 h-2 bg-slate-700 rounded-full overflow-hidden">
                    <div class="h-full bg-amber-400 rounded-full transition-all duration-1000" style="width: ${percentage}%"></div>
                </div>
            </div>`;
        }
        document.getElementById('rating-breakdown-container').innerHTML = breakdownHtml;

        document.getElementById('rating-loader').style.display = 'none';
        document.getElementById('rating-content').classList.remove('opacity-0');
    }

    function generateAvatarGradient(name) {
        const colors = [
            'from-blue-500 to-indigo-600',
            'from-emerald-500 to-teal-600',
            'from-amber-500 to-orange-600',
            'from-purple-500 to-pink-600',
            'from-rose-500 to-red-600'
        ];
        let hash = 0;
        for (let i = 0; i < name.length; i++) hash = name.charCodeAt(i) + ((hash << 5) - hash);
        return colors[Math.abs(hash) % colors.length];
    }

    function renderReviews(reviews) {
        if (!reviews || reviews.length === 0) return;

        let doubleReviews = [...reviews, ...reviews, ...reviews, ...reviews];
        let trackHtml = '';

        doubleReviews.forEach(review => {
            const initial = review.author_name ? review.author_name.charAt(0).toUpperCase() : 'U';
            
            // Map original Google API fields to UI Design Component
            const avatarHtml = review.profile_photo_url 
                ? `<img src="${review.profile_photo_url}" alt="${review.author_name}" class="w-12 h-12 rounded-full shadow-sm object-cover" />`
                : `<div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-sm bg-gradient-to-br ${generateAvatarGradient(review.author_name || 'User')}">${initial}</div>`;
                
            let text = review.text || '';
            if (text.length > 200) text = text.substring(0, 197) + '...';

            trackHtml += `
            <div class="w-[310px] sm:w-[380px] shrink-0 bg-slate-800 rounded-2xl p-6 sm:p-8 shadow-md border border-slate-700 flex flex-col justify-between transition-all duration-300 hover:shadow-xl hover:border-emerald-500/30 hover:-translate-y-1 h-auto min-h-[260px]">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-4">
                            ${avatarHtml}
                            <div>
                                <h4 class="font-bold text-white text-base tracking-wide">${review.author_name}</h4>
                                <div class="flex text-amber-400 text-xs mt-1">
                                    ${'★'.repeat(review.rating || 5)}${'☆'.repeat(5 - (review.rating || 5))}
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-400 flex-shrink-0">
                            <!-- Real Google G Icon -->
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                <path d="M12.24 10.285V13.4h6.887C18.2 15.614 15.645 18 12.24 18c-3.86 0-7-3.14-7-7s3.14-7 7-7c1.7 0 3.25.61 4.47 1.625l2.427-2.427C17.43 1.705 15.02 1 12.24 1 6.58 1 2 5.58 2 11.24s4.58 10.24 10.24 10.24c5.9 0 9.81-4.14 9.81-10 0-.67-.06-1.32-.18-1.9H12.24z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-6 font-medium">
                        "${text}"
                    </p>
                </div>
                <div class="text-xs text-slate-500 font-medium mt-auto">
                    ${review.relative_time_description || 'Baru saja'}
                </div>
            </div>`;
        });

        document.getElementById('reviews-marquee-track').innerHTML = trackHtml;
        document.getElementById('reviews-loader').classList.add('opacity-0');
        setTimeout(() => {
            document.getElementById('reviews-loader').style.display = 'none';
            document.getElementById('reviews-marquee-track').classList.remove('opacity-0');
        }, 300);
    }

    // Client Component Fetch Logic (Try/Catch implemented natively via fetch promise chain)
    fetch('/api/google-reviews')
        .then(response => {
            if (!response.ok) throw new Error('Server responded with an error status');
            return response.json();
        })
        .then(res => {
            // Check if there is data (either live data or backend fallback data)
            if (res.success && res.data) {
                if (res.fallback) {
                    console.warn("Google API Key or Place ID missing/invalid. Currently rendering Graceful Fallback data.");
                }
                const data = res.data;
                const stats = {
                    rating: data.rating || 5.0,
                    user_ratings_total: data.user_ratings_total || 11
                };
                renderRatingCard(stats);
                
                if (data.reviews && data.reviews.length > 0) {
                    renderReviews(data.reviews);
                }
            } else {
                throw new Error("No data structure returned from API");
            }
        })
        .catch(err => {
            // HIDDEN ERROR HANDLING: Render the exact fallback if frontend fetch crashes completely
            console.error('Client-side Fetch Error (API might be down):', err);
            
            // Client-side Graceful Fallback rendering
            renderRatingCard({ rating: 5.0, user_ratings_total: 11 });
            renderReviews([
                { author_name: "Agim Firdaus20_", rating: 5, text: "Terimakasih rootera plumbing atas pekerjaan saluran kloset di lampung, saluran sudah lancar, Teknisi ramah dan pengerjaan cepat", relative_time_description: 'Baru saja' },
                { author_name: "NUR SIDIK", rating: 5, text: "Saluran Wastafel Sudah Saya Lancar, terimakasih rootera plumbing", relative_time_description: 'Baru saja' },
                { author_name: "Radit", rating: 5, text: "Harga bersahabat, cepat, dan bergaransi, hasil maksimal, trm ksh J&J", relative_time_description: 'Baru saja' }
            ]);
        });
});
</script>
