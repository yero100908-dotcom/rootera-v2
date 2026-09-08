{{-- Emergency CTA Banner --}}
<section class="bg-gradient-to-r from-slate-950 via-blue-950 to-slate-950 text-white text-center px-4 sm:px-6 lg:px-8 pt-14 pb-28 lg:pb-16">
    <div class="max-w-2xl mx-auto">

        {{-- Pulsing urgency badge --}}
        <div class="inline-flex items-center gap-2 bg-red-500/20 border border-red-400/30 text-red-300 font-bold text-xs uppercase tracking-widest px-4 py-1.5 rounded-full mb-6">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-400"></span>
            </span>
            Darurat 24 Jam Nonstop
        </div>

        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold leading-tight tracking-tight mb-4">
            Saluran Air di {{ $locationShort }} Mampet Hari Ini?
        </h2>
        <p class="text-sm sm:text-base text-slate-300 leading-relaxed mb-8 max-w-lg mx-auto">
            Jangan biarkan air meluap dan merusak ruangan Anda. Tim spesialis Rootera siap meluncur cepat dengan penanganan bergaransi resmi tuntas 100%.
        </p>

        <a href="https://wa.me/{{ $city->whatsapp_number }}?text={{ urlencode('Halo Rootera, saluran saya mampet di ' . $locationName . '. Tolong bantu kirim teknisi sekarang.') }}"
           target="_blank"
           class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-emerald-500 hover:bg-emerald-400 text-white font-extrabold text-base shadow-xl shadow-emerald-500/30 hover:-translate-y-0.5 transition-all duration-200">
            <svg class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
            Hubungi Customer Service WhatsApp (24 Jam)
        </a>

    </div>
</section>
