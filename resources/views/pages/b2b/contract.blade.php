@extends('layouts.app')

@section('content')
<!-- B2B Contract Hero Header -->
<section style="background: linear-gradient(135deg, #0A2E78 0%, #061434 100%); color: #ffffff; padding: 4.5rem 1.5rem; border-bottom: 4px solid #169F81;">
    <div style="max-width: 1100px; margin: 0 auto; text-align: center;">
        <span style="background: rgba(22, 159, 129, 0.2); border: 1px solid rgba(22, 159, 129, 0.4); color: #2dd4bf; padding: 0.4rem 1.2rem; border-radius: 50px; font-size: 0.88rem; font-weight: 700; display: inline-block; margin-bottom: 1.25rem;">
            📜 Perjanjian Kerja Sama (PKS) &amp; SLA Corporate Retainer
        </span>
        <h1 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; line-height: 1.2; margin-bottom: 1rem; color: #ffffff;">
            Pengajuan Kontrak Preventive Maintenance Plumbing {{ $sector->sector_name }}
        </h1>
        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.85); max-width: 780px; margin: 0 auto; line-height: 1.6;">
            Dapatkan garansi perlindungan bebas pipa mampet 365 hari, reservasi teknisi dedicated, SLA tanggap darurat 24 jam, serta faktur pajak resmi PPN 11% dari holding PT/CV J&amp;J Group.
        </p>
    </div>
</section>

<!-- Contract Options & Application Form Section -->
<section style="padding: 4.5rem 1.5rem; background: #F8FAFC;">
    <div style="max-width: 1100px; margin: 0 auto;">
        
        {{-- Paket Kontrak Maintenance --}}
        <div style="margin-bottom: 3.5rem;">
            <div style="text-align: center; margin-bottom: 2.5rem;">
                <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Pilihan Skema B2B</span>
                <h2 style="color: #0A2E78; font-size: 2rem; font-weight: 800; margin-top: 0.3rem;">Skema Kontrak Perawatan Rutin Sektor {{ $sector->sector_name }}</h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                @if(!empty($sector->service_contract_options))
                    @foreach($sector->service_contract_options as $option)
                    <div style="background: #ffffff; border-radius: 18px; padding: 2rem; border: 1px solid #E2E8F0; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                        <div style="font-size: 2.2rem; margin-bottom: 0.75rem;">📅</div>
                        <h3 style="color: #0A2E78; font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $option }}</h3>
                        <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6; margin-bottom: 1.25rem;">Inspeksi periodik, pengurasan lumpur/lemak berkala, &amp; bebas biaya panggilan emergency 24 Jam.</p>
                        <span style="color: #169F81; font-weight: 700; font-size: 0.88rem;">✓ Diskon Spesial B2B Corporate</span>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Direct Contact Form for Corporate SLA --}}
        <div style="background: #ffffff; border-radius: 24px; padding: 3rem 2rem; border: 1px solid #E2E8F0; box-shadow: 0 10px 30px rgba(0,0,0,0.05); max-width: 800px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h3 style="color: #0A2E78; font-size: 1.75rem; font-weight: 800; margin-bottom: 0.4rem;">Formulir Pengajuan Penawaran B2B</h3>
                <p style="color: #64748B; font-size: 0.95rem;">Isi formulir singkat di bawah ini atau langsung kirim pesan melalui WhatsApp Sales Corporate:</p>
            </div>

            <form action="{{ route('kontak.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.25rem;">
                @csrf
                <input type="hidden" name="layanan" value="Kontrak Maintenance B2B - {{ $sector->sector_name }}">

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.88rem; font-weight: 700; color: #334155; margin-bottom: 0.4rem;">Nama Perusahaan / Instansi *</label>
                        <input type="text" name="nama" required placeholder="PT. / CV. / Nama Perusahaan" style="width: 100%; padding: 0.8rem 1rem; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.95rem;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.88rem; font-weight: 700; color: #334155; margin-bottom: 0.4rem;">Nomor WhatsApp PIC / Purchasing *</label>
                        <input type="tel" name="telepon" required placeholder="08123456789" style="width: 100%; padding: 0.8rem 1rem; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.95rem;">
                    </div>
                </div>

                <div>
                    <label style="display: block; font-size: 0.88rem; font-weight: 700; color: #334155; margin-bottom: 0.4rem;">Alamat Gedung / Lokasi Properti *</label>
                    <input type="text" name="alamat" required placeholder="Kota & Alamat Lengkap Operasional" style="width: 100%; padding: 0.8rem 1rem; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.95rem;">
                </div>

                <div>
                    <label style="display: block; font-size: 0.88rem; font-weight: 700; color: #334155; margin-bottom: 0.4rem;">Rincian Kebutuhan Maintenance &amp; Jumlah Titik Saluran *</label>
                    <textarea name="pesan" rows="4" required placeholder="Jelaskan kebutuhan pemeliharaan pipa, luas gedung, atau masalah saluran saat ini..." style="width: 100%; padding: 0.8rem 1rem; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.95rem;"></textarea>
                </div>

                <button type="submit" class="btn" style="background: #0A2E78; color: #ffffff; font-weight: 800; font-size: 1.05rem; padding: 1rem; border-radius: 12px; border: none; cursor: pointer;">
                    🚀 Kirim Permintaan Penawaran B2B Resmi
                </button>
            </form>
        </div>

    </div>
</section>
@endsection
