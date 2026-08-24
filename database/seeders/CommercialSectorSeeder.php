<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceSector;
use Illuminate\Support\Str;

class CommercialSectorSeeder extends Seeder
{
    public function run(): void
    {
        $sectors = [
            [
                'sector_name' => 'Restoran, Cafe, Cloud Kitchen & F&B',
                'slug' => 'restoran-cafe',
                'icon' => '🍽️',
                'hero_headline' => 'Solusi Pembersihan Grease Trap & Pelancaran Pipa Dapur Komersial F&B',
                'short_description' => 'Penanganan kerak lemak jenuh, leher angsa kitchen sink, & floor drain dapur komersial tanpa merusak jam operasional restoran.',
                'pain_points' => [
                    'Pipa pembuangan sink tersumbat lemak membeku & sisa bahan makanan.',
                    'Bau tidak sedap keluar dari grease trap & floor drain mengganggu kenyamanan pengunjung.',
                    'Air meluap ke area kitchen saat jam sibuk dinner/lunch peak hours.',
                    'Risiko sanksi dinas kesehatan karena sanitasi drainase yang buruk.'
                ],
                'solutions_offered' => [
                    'Pembersihan grease trap manual & degassing tanpa zat kimia berbahaya.',
                    'Hydro-jetting rotasi spiral penghancur blokade lemak keras.',
                    'Pemasangan strainer & perawatan pencegahan periodik (Monthly SLA).',
                    'SOP pengerjaan steril & ramah lingkungan (Food-grade compliance).'
                ],
                'sla_guarantee' => 'Respon Darurat 30-45 Menit | SLA Shift Malam Non-Stop',
                'recommended_methods' => [
                    'Spiral Rotary RIDGID Heavy Duty',
                    'High Pressure Hydro-Jetting (150-250 Bar)',
                    'CCTV Pipe Inspection Camera (Deteksi Titik Penumpukan)'
                ],
                'service_contract_options' => [
                    'Kontrak Maintenance Bulanan (Monthly Routine Drain Flushing)',
                    'Kontrak Triwulan (Quarterly Deep Jetting)',
                    'Kontrak On-Demand Emergency Calling 24 Jam'
                ],
                'sort_order' => 1,
            ],
            [
                'sector_name' => 'Hotel, Resort, Apartemen & Kos Eksklusif',
                'slug' => 'hotel-apartemen',
                'icon' => '🏨',
                'hero_headline' => 'Maintenance Pipa Vertical Riser Stack & Drainase Kamar Mandi Bertingkat',
                'short_description' => 'Spesialis pemeliharaan pipa riser utama, pembersihan saluran floor drain kamar mandi bertingkat tanpa getaran & kebisingan yang mengganggu tamu.',
                'pain_points' => [
                    'Sumbatan pada pipa riser vertikal menyebabkan luapan di beberapa unit sekaligus.',
                    'Rontokan rambut, busa sabun & lemak mengkristal di dalam shaft pipa bertingkat.',
                    'Keluhan tamu hotel/penghuni apartemen akibat bau & air meluap dari kloset.',
                    'Persetujuan izin kerja (Work Permit) ketat & standar K3 gedung bertingkat.'
                ],
                'solutions_offered' => [
                    'Pembersihan pipa vertical stack riser dari top roof hingga basement.',
                    'Descaling pipa air kotor menggunakan mesin rotasi tanpa getaran ekstrem.',
                    'Pemeriksaan titik kebocoran concealed pipe menggunakan kamera CCTV HD.',
                    'Penyediaan laporan teknis bertanda tangan engineer resmi J&J Group.'
                ],
                'sla_guarantee' => 'SLA Pengerjaan Jam Istirahat (Quiet Hours Standard) & Respon 24 Jam',
                'recommended_methods' => [
                    'Flexible Shaft Cutter Rotary Machine',
                    'CCTV Inspection System HD Video Recording',
                    'Vacuum Pressure Drain Flusher'
                ],
                'service_contract_options' => [
                    'Preventive Maintenance Kontrak Tahunan (Annual Building Shaft Maintenance)',
                    'Kontrak Triwulan Audit Sanitasi & Riser Flushing',
                    'Service Retainer Dedicated On-Site Technician'
                ],
                'sort_order' => 2,
            ],
            [
                'sector_name' => 'Rumah Sakit, Klinik & Fasilitas Kesehatan',
                'slug' => 'rumah-sakit-klinik',
                'icon' => '🏥',
                'hero_headline' => 'Pelancaran Drainase Steril & Sanitasi Limbah Cair Non-Infeksius',
                'short_description' => 'Penanganan profesional pipa pembuangan medis & umum dengan prosedur higienis ketat, bebas bahan kimia korosif, dan garansi faktur resmi.',
                'pain_points' => [
                    'Saluran pembuangan area laboratorium, laundry & toilet rawat inap tersumbat.',
                    'Standar sterilitas tinggi (bebas polusi kontaminasi & debu saat pengerjaan).',
                    'Potensi bahaya jika menggunakan kimia keras seperti soda api pada sistem IPAL/STP.',
                    'Kebutuhan faktur pajak legal PT/CV & kelengkapan sertifikat K3 penanggung jawab.'
                ],
                'solutions_offered' => [
                    'Metode mekanis 100% tanpa bahan kimia cair beracun / korosif.',
                    'Pembersihan saluran laundry & pantry rumah sakit secara bebas bau.',
                    'Teknisi berseragam APD steril lengkap & mematuhi SOP Rumah Sakit.',
                    'Penerbitan Invoice B2B + Faktur Pajak PPN 11% resmi holding J&J Group.'
                ],
                'sla_guarantee' => 'Respon Prioritas Utama Medical Urgent Response (<30 Menit)',
                'recommended_methods' => [
                    'Non-Chemical Mechanical Rotary Tool',
                    'Ultra-Quiet Hydro Flusher',
                    'Digital Pipe Diagnostic Scope'
                ],
                'service_contract_options' => [
                    'Kontrak Routine Service Bulanan (B2B Healthcare Retainer)',
                    'Kontrak Tahunan Pemeliharaan IPAL & Sewer Line',
                    'SLA Tanggap Darurat B2B Emergency Nonstop'
                ],
                'sort_order' => 3,
            ],
            [
                'sector_name' => 'Pabrik, Manufaktur & Pergudangan',
                'slug' => 'pabrik-industri',
                'icon' => '🏭',
                'hero_headline' => 'Hydro-Jetting High Pressure Pipa Limbah Industri Diameter Besar',
                'short_description' => 'Pembersihan pipa limbah industri, saluran pembuangan pabrik diameter besar, & pengurasan sedimen kerak kimia manufaktur bergaransi.',
                'pain_points' => [
                    'Endapan minyak pelumas, serat material, & kerak kimia menyumbat pipa 6"-12".',
                    'Banjir limbah cair di area produksi/pergudangan menghentikan aktivitas mesin.',
                    'Proses administrasi vendor (CSMS, E-Procurement, Surat Perjanjian Kerja Sama) rumit.',
                    'Kebutuhan garansi resmi pengerjaan tuntas dengan pembuktian CCTV visual.'
                ],
                'solutions_offered' => [
                    'Unit Hydro-Jetting tekanan tinggi (up to 300 Bar) untuk rontokkan endapan membandel.',
                    'Pencucian pipa diameter jumbo hingga panjang 100+ meter per jalur.',
                    'Kemudahan legalitas vendor lengkap (NIB, PKP, Surat Izin Usaha, K3 Compliance).',
                    'Pemeriksaan before & after pengerjaan dengan video inspeksi kamera CCTV.'
                ],
                'sla_guarantee' => 'SLA Respon Teknisi Industri 24 Jam & Layanan Shift Malam/Akhir Pekan',
                'recommended_methods' => [
                    'Heavy Duty Hydro-Jetting Unit (Industrial Pressure)',
                    'Industrial Cable Rotary Auger Machine',
                    'Pan-and-Tilt Pipe Inspection Crawler CCTV'
                ],
                'service_contract_options' => [
                    'Kontrak Maintenance Pabrik Per Semester (Bi-Annual Industrial Flushing)',
                    'Kontrak Annual SLA Maintenance (Preventive Maintenance 1 Tahun)',
                    'Custom Project B2B Agreement for Plant Expansion'
                ],
                'sort_order' => 4,
            ],
            [
                'sector_name' => 'Gedung Perkantoran & Coworking Space',
                'slug' => 'perkantoran-coworking',
                'icon' => '🏢',
                'hero_headline' => 'Preventive Maintenance Pipa Pantry & Toilet Perkantoran Komersial',
                'short_description' => 'Solusi tepat pemeliharaan rutin saluran toilet umum karyawan, pantry kantor, & pembuangan AC tanpa mengganggu ketenangan kerja.',
                'pain_points' => [
                    'Air meluap di toilet wanita/pria saat jam kerja kantor (jam sibuk bisnis).',
                    'Saluran cuci piring pantry tersumbat ampas kopi, teh, & minyak makanan.',
                    'Kebisingan pengerjaan yang berpotensi mengganggu meeting & konsentrasi kerja.',
                    'Persyaratan pembayaran tempo invoicing (Top 30 days) & Faktur Pajak B2B.'
                ],
                'solutions_offered' => [
                    'Jadwal penanganan flexibel (After-Hours Shift / Weekend Working Hours).',
                    'Pembersihan pipa pantry & floor drain dengan alat bebas getaran/bising.',
                    'Layanan kontrak pemeliharaan berkala dengan tarif hemat terjangkau.',
                    'Dukungan syarat pembayaran B2B corporate invoice & Faktur Pajak PPN.'
                ],
                'sla_guarantee' => 'Respon Teknisi Gedung 30-45 Menit & Fleksibilitas Jam Kerja',
                'recommended_methods' => [
                    'Compact Silent Rotary Spiral',
                    'Air Hydro Pressure Gun',
                    'Mini CCTV Inspection Scope'
                ],
                'service_contract_options' => [
                    'Kontrak Maintenance Bulanan (Monthly Office Building Retainer)',
                    'Kontrak Per Tiga Bulan (Quarterly Pantry & Toilet Flushing)',
                    'Corporate On-Demand Call Agreement'
                ],
                'sort_order' => 5,
            ],
            [
                'sector_name' => 'Instansi Pemerintah, Swasta & Kampus / Sekolah',
                'slug' => 'instansi-kampus',
                'icon' => '🏛️',
                'hero_headline' => 'Pengadaan Jasa Pelancaran Drainase Gedung Publik & Institusi Pendidikan',
                'short_description' => 'Mitra resmi pengadaan jasa pemeliharaan sanitasi instansi pemerintah, sekolah, & gedung universitas berlegalitas hukum sah PT/CV J&J Group.',
                'pain_points' => [
                    'Pipa drainase gedung lama tersumbat sedimen kapur & lumpur menahun.',
                    'Kebutuhan dokumen pengadaan barang/jasa resmi (SPK, BAST, Faktur Pajak, E-Faktur).',
                    'Penggunaan berkapasitas tinggi oleh ribuan siswa/mahasiswa/pegawai.',
                    'Kebutuhan jaminan garansi pekerjaan tuntas 100% tanpa biaya tambahan.'
                ],
                'solutions_offered' => [
                    'Pembersihan menyeluruh sistem pembuangan air hujan & toilet instansi.',
                    'Dukungan penuh kelengkapan administrasi tender & e-procurement instansi.',
                    'Garansi pekerjaan resmi 30 hari hingga SLA kontrak kerja berakhir.',
                    'Teknisi berpengalaman menangani instalasi pipa komersial & institusi.'
                ],
                'sla_guarantee' => 'Respon Cepat Tanggap Darurat & Layanan Pendampingan Tender',
                'recommended_methods' => [
                    'Heavy Duty Cable Rotary Machine',
                    'Hydro-Jetting Pipe Cleaner',
                    'CCTV Drain Sewer Camera'
                ],
                'service_contract_options' => [
                    'Kontrak Pengadaan Tahunan (Annual Institutional Retainer)',
                    'Perjanjian Kerja Sama (PKS) Pemeliharaan Drainase Kampus',
                    'Kontrak Project-Based Tender Maintenance'
                ],
                'sort_order' => 6,
            ],
            [
                'sector_name' => 'Mall, Shopping Center & Food Court',
                'slug' => 'mall-shopping-center',
                'icon' => '🏬',
                'hero_headline' => 'Penanganan Drainase Terpadu Pusat Perbelanjaan & Area Food Court',
                'short_description' => 'Pembersihan sistem pembuangan terpadu mall, grease trap food court, & toilet umum pusat perbelanjaan skala besar.',
                'pain_points' => [
                    'Sumbatan berulang di area food court akibat lemak dari puluhan tenant F&B.',
                    'Ketentuan pengerjaan hanya boleh dilakukan saat malam hari (Mall Closing Hours).',
                    'Risiko pencemaran bau di lorong mall yang mengganggu pengunjung.',
                    'Jalur pipa meliuk-liuk & sangat panjang melewati beberapa lantai mall.'
                ],
                'solutions_offered' => [
                    'Layanan Night Shift Working (Operasional Malam Pukul 22.00 - 06.00 WIB).',
                    'Mesin Spiral Rotary jarak jauh sanggup menjangkau belokan pipa rumit.',
                    'Pembersihan & descaling pipa secara steril bebas dari polusi bau kotor.',
                    'Kerja sama resmi dengan manajemen building operational Mall.'
                ],
                'sla_guarantee' => 'Guaranteed Night Shift Execution & Respon Emergency 24 Jam',
                'recommended_methods' => [
                    'Extended Long-Distance Cable Rotary',
                    'High Pressure Night Jetting Unit',
                    'CCTV Video Pipe Inspector'
                ],
                'service_contract_options' => [
                    'Kontrak Routin Night Shift Monthly Maintenance',
                    'Kontrak Maintenance Food Court Tenant Integrated',
                    'Annual Retainer Building Service'
                ],
                'sort_order' => 7,
            ],
            [
                'sector_name' => 'Kawasan Ruko & Kompleks Bisnis',
                'slug' => 'ruko-kompleks-bisnis',
                'icon' => '🏪',
                'hero_headline' => 'Jasa Pelancaran Saluran Got Ruko & Bak Kontrol Pembuangan Bersama',
                'short_description' => 'Solusi cepat perbaikan pipa tersumbat kawasan deretan ruko bisnis, salon, minimarket, & office house dengan garansi tuntas tanpa bongkar.',
                'pain_points' => [
                    'Saluran pembuangan utama ruko tersumbat karena bak kontrol bersama mampet.',
                    'Usaha salon/laundry di ruko terhambat karena air busa/sampah meluap.',
                    'Konflik antar pemilik ruko akibat aliran air kotor tersumbat.',
                    'Butuh pengerjaan cepat agar aktivitas jualan/bisnis ruko segera pulih.'
                ],
                'solutions_offered' => [
                    'Pembersihan got depan ruko & bak kontrol utama perumahan/ruko.',
                    'Rontokkan endapan busa sabun, rambut, & sisa material laundry/salon.',
                    'Pelancaran leher angsa toilet & wastafel ruko hanya dalam 30-45 menit.',
                    'Invoice resmi & faktur pembayaran terpisah per unit ruko.'
                ],
                'sla_guarantee' => 'Respon Datang Cepat (25-40 Menit Area Jabodetabek & Kota Target)',
                'recommended_methods' => [
                    'Sectional Cable Machine Rotary',
                    'High Pressure Washer Drain Cleaner',
                    'Inspection Scope Camera'
                ],
                'service_contract_options' => [
                    'Kontrak Perawatan Ruko Per 3 Bulan (Quarterly Shophouse Drain Clean)',
                    'Kontrak Perawatan Bak Kontrol Bersama Kawasan Ruko',
                    'Call-On-Demand Rapid Response Agreement'
                ],
                'sort_order' => 8,
            ],
        ];

        foreach ($sectors as $data) {
            ServiceSector::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'sector_name' => $data['sector_name'],
                    'icon' => $data['icon'],
                    'hero_headline' => $data['hero_headline'],
                    'short_description' => $data['short_description'],
                    'pain_points' => $data['pain_points'],
                    'solutions_offered' => $data['solutions_offered'],
                    'sla_guarantee' => $data['sla_guarantee'],
                    'recommended_methods' => $data['recommended_methods'],
                    'service_contract_options' => $data['service_contract_options'],
                    'sort_order' => $data['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
