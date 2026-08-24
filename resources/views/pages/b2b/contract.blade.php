@extends('layouts.app')

@section('content')
{{-- B2B Corporate Hero Header --}}
<section class="relative bg-gradient-to-br from-[#061434] via-[#0A2E78] to-[#134074] text-white py-16 sm:py-20 overflow-hidden border-b-4 border-[#169F81]">
    {{-- Ambient Glow Overlay --}}
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-[#169F81]/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-extrabold bg-[#169F81]/20 border border-[#169F81]/40 text-[#2dd4bf] uppercase tracking-wider mb-4 shadow-sm backdrop-blur-md">
            <span>📜 PERJANJIAN KERJA SAMA (PKS) &amp; SLA CORPORATE RETAINER</span>
        </div>
        <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight font-['Plus_Jakarta_Sans',sans-serif] max-w-4xl mx-auto">
            Pengajuan Kontrak Maintenance Plumbing <span class="text-[#10B981]">{{ $sector->sector_name }}</span>
        </h1>
        <p class="text-slate-300 text-sm sm:text-base lg:text-lg max-w-3xl mx-auto mt-4 leading-relaxed">
            Dapatkan garansi bebas gangguan pipa tersumbat 365 hari, reservasi teknisi dedicated, SLA tanggap darurat 24 jam, serta Faktur Pajak Resmi PPN 11% dari PT/CV J&amp;J Group.
        </p>
    </div>
</section>

{{-- Main Form & Benefits Grid Section --}}
<section class="py-12 sm:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            
            {{-- Form Column (8 Cols) --}}
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/90 shadow-xl relative overflow-hidden">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl font-bold border border-emerald-200/60">
                        📄
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">Formulir Penawaran Kontrak B2B</h2>
                        <p class="text-xs sm:text-sm text-slate-500">Lengkapi data berikut untuk estimasi &amp; survey gratis lokasi operasional Anda.</p>
                    </div>
                </div>

                <form id="b2bContractForm" onsubmit="handleB2bSubmit(event)" class="space-y-5">
                    @csrf
                    <input type="hidden" id="b2b_sector_name" value="{{ $sector->sector_name }}">

                    {{-- Nama Perusahaan & Sektor --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="company_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Perusahaan / Instansi <span class="text-red-500">*</span></label>
                            <input type="text" id="company_name" required placeholder="PT / CV / Nama Usaha" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm text-slate-900 bg-slate-50/50">
                        </div>
                        <div>
                            <label for="property_category" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Sektor / Jenis Properti <span class="text-red-500">*</span></label>
                            <select id="property_category" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm text-slate-900 bg-slate-50/50">
                                <option value="{{ $sector->sector_name }}" selected>{{ $sector->sector_name }}</option>
                                <option value="Restoran / Cafe / Cloud Kitchen">Restoran / Cafe / Cloud Kitchen</option>
                                <option value="Hotel / Apartemen / Kos Eksklusif">Hotel / Apartemen / Kos Eksklusif</option>
                                <option value="Rumah Sakit / Klinik Medis">Rumah Sakit / Klinik Medis</option>
                                <option value="Pabrik / Manufaktur / Pergudangan">Pabrik / Manufaktur / Pergudangan</option>
                                <option value="Gedung Perkantoran / Coworking">Gedung Perkantoran / Coworking</option>
                                <option value="Instansi Pemerintah / Kampus">Instansi Pemerintah / Kampus</option>
                                <option value="Mall / Shopping Center / Food Court">Mall / Shopping Center / Food Court</option>
                                <option value="Kawasan Ruko / Kompleks Bisnis">Kawasan Ruko / Kompleks Bisnis</option>
                            </select>
                        </div>
                    </div>

                    {{-- PIC & Kontak --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="pic_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama PIC / Jabatan <span class="text-red-500">*</span></label>
                            <input type="text" id="pic_name" required placeholder="Nama Penanggung Jawab / GA / Purchasing" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm text-slate-900 bg-slate-50/50">
                        </div>
                        <div>
                            <label for="pic_phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor WhatsApp PIC <span class="text-red-500">*</span></label>
                            <input type="tel" id="pic_phone" required placeholder="081234567890" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm text-slate-900 bg-slate-50/50">
                        </div>
                    </div>

                    {{-- Estimasi Titik & Skema Paket --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="outlets_count" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Estimasi Titik Saluran / Panjang Pipa <span class="text-red-500">*</span></label>
                            <select id="outlets_count" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm text-slate-900 bg-slate-50/50">
                                <option value="1 - 5 Titik Saluran">1 - 5 Titik Saluran</option>
                                <option value="6 - 15 Titik Saluran">6 - 15 Titik Saluran</option>
                                <option value="16 - 50 Titik Saluran">16 - 50 Titik Saluran</option>
                                <option value="50+ Titik (Kawasan / Gedung Jumbo)">50+ Titik (Kawasan / Gedung Jumbo)</option>
                            </select>
                        </div>
                        <div>
                            <label for="contract_package" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pilihan Skema Maintenance <span class="text-red-500">*</span></label>
                            <select id="contract_package" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm text-slate-900 bg-slate-50/50">
                                <option value="Kontrak Routine Bulanan (Monthly SLA)">Kontrak Routine Bulanan (Monthly SLA)</option>
                                <option value="Kontrak Per Tiga Bulan (Quarterly Deep Flushing)">Kontrak Per Tiga Bulan (Quarterly Deep Flushing)</option>
                                <option value="Kontrak Tahunan (Annual Corporate SLA Retainer)">Kontrak Tahunan (Annual Corporate SLA Retainer)</option>
                                <option value="Insidental Emergency Call (Panggilan Sewaktu-waktu)">Insidental Emergency Call (Panggilan Sewaktu-waktu)</option>
                            </select>
                        </div>
                    </div>

                    {{-- Alamat Operasional Gedung --}}
                    <div>
                        <label for="building_address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Lengkap Operasional Gedung <span class="text-red-500">*</span></label>
                        <input type="text" id="building_address" required placeholder="Kota & Alamat Lengkap Lokasi Properti" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm text-slate-900 bg-slate-50/50">
                    </div>

                    {{-- Catatan Tambahan --}}
                    <div>
                        <label for="additional_notes" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Catatan Keluhan &amp; Spesifikasi Tambahan</label>
                        <textarea id="additional_notes" rows="3" placeholder="Jelaskan jenis masalah pipa (lemakbeu, kerak kimia, riser stack) atau jadwal survey yang diinginkan..." class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm text-slate-900 bg-slate-50/50"></textarea>
                    </div>

                    {{-- CTA Action Buttons --}}
                    <div class="pt-4 flex flex-col sm:flex-row gap-3">
                        <button type="submit" class="flex-1 bg-[#10B981] hover:bg-[#059669] text-white font-extrabold text-sm py-4 px-6 rounded-2xl transition-all shadow-lg hover:shadow-emerald-500/20 flex items-center justify-center gap-2">
                            <span>🚀 Kirim Penawaran via WhatsApp Dispatcher</span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Floating Benefit & SLA Summary Column (5 Cols) --}}
            <div class="lg:col-span-5 space-y-6">
                
                {{-- Floating Card 1: Corporate Trust Guarantee --}}
                <div class="bg-gradient-to-br from-[#0B2545] to-[#134074] rounded-3xl p-6 sm:p-8 text-white shadow-xl border border-white/10 relative overflow-hidden">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl font-bold mb-4 border border-emerald-500/40">
                        🏢
                    </div>
                    <h3 class="text-xl font-bold font-['Plus_Jakarta_Sans',sans-serif] text-white mb-2">Jaminan Kemitraan Resmi J&amp;J Group</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mb-6">
                        Pengadaan jasa perbaikan sanitasi &amp; perawatan pipa terpercaya dengan legalitas hukum sah holding PT/CV J&amp;J Group.
                    </p>

                    <div class="space-y-3.5 border-t border-white/15 pt-5 text-xs sm:text-sm">
                        <div class="flex items-start gap-3">
                            <span class="text-emerald-400 font-bold">✓</span>
                            <div>
                                <strong class="text-white">Faktur Pajak PPN 11% Resmi</strong>
                                <p class="text-slate-300 text-xs">Penerbitan Invoice B2B corporate, e-Faktur, &amp; dokumen BAST lengkap.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="text-emerald-400 font-bold">✓</span>
                            <div>
                                <strong class="text-white">SLA Prioritas Response 24 Jam</strong>
                                <p class="text-slate-300 text-xs">Tim teknisi dedicated siap datang &lt; 30-45 menit saat keadaan darurat.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="text-emerald-400 font-bold">✓</span>
                            <div>
                                <strong class="text-white">Standar K3 &amp; Bebas Bahan Kimia</strong>
                                <p class="text-slate-300 text-xs">Metode rotasi spiral &amp; hydro jetting presisi tanpa merusak pipa gedung.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="text-emerald-400 font-bold">✓</span>
                            <div>
                                <strong class="text-white">Free Survey &amp; Pipe Audit</strong>
                                <p class="text-slate-300 text-xs">Pemeriksaan titik potensi sumbatan dengan kamera CCTV profesional.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Direct Contact Box --}}
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-md text-center">
                    <div class="text-slate-400 text-xs uppercase font-bold tracking-wider mb-1">Corporate Account Manager</div>
                    <div class="text-lg font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mb-3">Butuh Konsultasi Langsung?</div>
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Corporate Manager, kami dari perusahaan mau konsultasi kontrak maintenance plumbing ' . $sector->sector_name) }}" target="_blank" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold py-3 px-5 rounded-xl transition-all w-full justify-center">
                        <span>📞 Hubungi B2B Account Manager (24 Jam)</span>
                    </a>
                </div>

            </div>

        </div>

    </div>
</section>

@push('scripts')
<script>
function handleB2bSubmit(e) {
    e.preventDefault();
    
    const company = document.getElementById('company_name').value;
    const category = document.getElementById('property_category').value;
    const pic = document.getElementById('pic_name').value;
    const phone = document.getElementById('pic_phone').value;
    const outlets = document.getElementById('outlets_count').value;
    const pkg = document.getElementById('contract_package').value;
    const address = document.getElementById('building_address').value;
    const notes = document.getElementById('additional_notes').value;

    const message = `*PENGAJUAN KONTRAK MAINTENANCE B2B ROOTERA*\n\n` +
                    `• *Perusahaan/Instansi*: ${company}\n` +
                    `• *Sektor/Properti*: ${category}\n` +
                    `• *PIC/Jabatan*: ${pic}\n` +
                    `• *No. WA PIC*: ${phone}\n` +
                    `• *Jumlah Titik*: ${outlets}\n` +
                    `• *Pilihan Skema*: ${pkg}\n` +
                    `• *Alamat Gedung*: ${address}\n` +
                    (notes ? `• *Catatan Spesifikasi*: ${notes}\n\n` : `\n`) +
                    `Mohon dapat dikirimkan Surat Penawaran Resmi & Jadwal Survey Lokasi. Terima kasih.`;

    const waUrl = `https://wa.me/6281385404000?text=${encodeURIComponent(message)}`;
    window.open(waUrl, '_blank');
}
</script>
@endpush
@endsection
