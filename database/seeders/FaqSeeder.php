<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqCategory;
use App\Models\Faq;
use Illuminate\Support\Str;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        // First reset all is_featured_home flags to false
        Faq::query()->update(['is_featured_home' => false]);

        $cats = FaqCategory::all()->keyBy('slug');

        $faqs = [
            // 1. Biaya & Estimasi Harga
            [
                'cat' => 'biaya-dan-estimasi-harga',
                'question' => 'Berapa estimasi biaya untuk perbaikan saluran mampet?',
                'answer' => 'Biaya jasa pelancaran pipa mampet di Rootera Plumbing sangat transparan dan kompetitif. Estimasi harga dihitung berdasarkan tingkat keparahan sumbatan, diameter pipa, dan jarak lokasi. Teknisi kami selalu melakukan pengecekan lokasi (survei/diagnosa) terlebih dahulu dan menyampaikan kepastian harga sebelum pengerjaan dimulai tanpa biaya tersembunyi.',
                'is_featured_home' => true,
                'sort_order' => 1,
            ],
            [
                'cat' => 'biaya-dan-estimasi-harga',
                'question' => 'Apakah pembayaran dilakukan jika saluran pipa gagal dilancarkan?',
                'answer' => 'Tidak. Rootera Plumbing menerapkan prinsip No Cure No Pay. Jika tim teknisi kami tidak berhasil melancarkan saluran pipa yang mampet sesuai dengan kesepakatan awal, Anda tidak dikenakan biaya pengerjaan sama sekali.',
                'is_featured_home' => false,
                'sort_order' => 4,
            ],
            [
                'cat' => 'biaya-dan-estimasi-harga',
                'question' => 'Apakah Rootera melayani penerbitan Faktur Pajak PPN & Invoice resmi B2B?',
                'answer' => 'Ya, sebagai divisi resmi J&J Group, Rootera Plumbing dapat menerbitkan Faktur Pajak PPN 11%, E-Faktur, Invoice legal perusahaan, serta Berita Acara Pengerjaan untuk kebutuhan administrasi perusahaan, hotel, restoran, maupun instansi pemerintah.',
                'is_featured_home' => false,
                'sort_order' => 5,
            ],
            [
                'cat' => 'biaya-dan-estimasi-harga',
                'question' => 'Metode pembayaran apa saja yang diterima?',
                'answer' => 'Kami menerima pembayaran tunai di tempat setelah pengerjaan selesai, Transfer Bank / m-Banking (BCA, Mandiri, BNI, BRI), QRIS, serta pembayaran via Term of Payment (TOP) untuk klien kontrak B2B yang telah menandatangani MoU.',
                'is_featured_home' => false,
                'sort_order' => 6,
            ],

            // 2. Metode & Teknologi Alat
            [
                'cat' => 'metode-dan-teknologi-alat',
                'question' => 'Bagaimana cara pengerjaan pelancaran pipa tanpa bongkar lantai/ubin?',
                'answer' => 'Rootera Plumbing menggunakan mesin Drain Cleaner Spiral Cable Rotary canggih. Kabel baja fleksibel berputar otomatis mengikuti lekukan pipa (elbow/knee) untuk menghancurkan, menarik, dan membersihkan kerak lemak, rambut, atau sampah tanpa merusak maupun membongkar lantai keramik rumah Anda.',
                'is_featured_home' => false,
                'sort_order' => 7,
            ],
            [
                'cat' => 'metode-dan-teknologi-alat',
                'question' => 'Apa itu teknologi Hydro-Jetting dan kapan alat ini digunakan?',
                'answer' => 'Hydro-Jetting adalah metode pembersihan pipa menggunakan semprotan air bertekanan ultra-tinggi (150-300 Bar). Metode ini digunakan khusus untuk pembilasan pipa limbah industri, saluran utama komersial (main drain), grease trap restoran berdiameter besar, serta pipa pipa pabrik yang dipenuhi endapan lumpur pekat atau kerak semen.',
                'is_featured_home' => false,
                'sort_order' => 8,
            ],
            [
                'cat' => 'metode-dan-teknologi-alat',
                'question' => 'Apakah mesin Rootera aman untuk saluran pipa paralon / PVC rumah tangga?',
                'answer' => 'Sangat aman. Kabel spiral rotary kami dirancang fleksibel dengan fleksibilitas elastik tinggi sehingga tidak mengikis atau memecahkan dinding pipa PVC paralon (tipe D maupun AW) standar perumahan.',
                'is_featured_home' => false,
                'sort_order' => 9,
            ],
            [
                'cat' => 'metode-dan-teknologi-alat',
                'question' => 'Apakah Rootera memiliki fasilitas Inspeksi Kamera CCTV Pipa?',
                'answer' => 'Ya, kami dilengkapi kamera inspek pipa waterproof HD berpenerangan LED dengan sistem pencatat meteran digital. CCTV pipa digunakan untuk mendeteksi posisi kerusakan pipa patah, sambungan lepas, atau benda keras yang tersumbat jauh di dalam tanah.',
                'is_featured_home' => false,
                'sort_order' => 10,
            ],

            // 3. Jaminan & Garansi Layanan
            [
                'cat' => 'jaminan-dan-garansi-layanan',
                'question' => 'Apakah ada jaminan garansi untuk hasil pengerjaan pipa mampet?',
                'answer' => 'Ya, seluruh pengerjaan pelancaran pipa mampet di Rootera Plumbing dilindungi Garansi Resmi 30 Hari. Jika sumbatan berulang dalam masa garansi, teknisi kami mengerjakan ulang tanpa dipungut biaya pengerjaan lagi.',
                'is_featured_home' => true,
                'sort_order' => 3,
            ],
            [
                'cat' => 'jaminan-dan-garansi-layanan',
                'question' => 'Bagaimana prosedur klaim garansi jika pipa kembali mampet?',
                'answer' => 'Klaim garansi sangat mudah: cukup hubungi Customer Service Rootera via WhatsApp dengan melampirkan foto nota garansi / nomor HP terdaftar. Tim teknisi terdekat akan langsung dijadwalkan ulang ke lokasi Anda tanpa dipungut biaya pengerjaan lagi.',
                'is_featured_home' => false,
                'sort_order' => 11,
            ],
            [
                'cat' => 'jaminan-dan-garansi-layanan',
                'question' => 'Apakah garansi berlaku untuk pipa yang rusak fisik / patah?',
                'answer' => 'Garansi 30 hari berlaku penuh untuk masalah sumbatan berulang akibat kotoran/kerak. Namun jika dari hasil diagnosa CCTV ditemukan bahwa pipa mengalami kerusakan struktur fisik (patah pecah akibat pergerakan tanah atau tertembus akar pohon), kami akan memberikan rekomendasi perbaikan konstruksi.',
                'is_featured_home' => false,
                'sort_order' => 12,
            ],

            // 4. Cakupan Wilayah & Respon
            [
                'cat' => 'cakupan-wilayah-dan-respon',
                'question' => 'Wilayah mana saja yang masuk dalam area jangkauan layanan Anda?',
                'answer' => 'Kami melayani seluruh wilayah perkotaan & kabupaten di DKI Jakarta, Banten (Tangerang, Tangsel, Serang, Cilegon), Jawa Barat (Bogor, Depok, Bekasi, Bandung, Cirebon, Karawang, Purwakarta, Sukabumi), Jawa Tengah & DIY (Semarang, Solo, Magelang, Jogja, Kudus, Purwokerto), Jawa Timur (Surabaya, Sidoarjo, Malang), serta Lampung.',
                'is_featured_home' => true,
                'sort_order' => 2,
            ],
            [
                'cat' => 'cakupan-wilayah-dan-respon',
                'question' => 'Berapa lama estimasi teknisi tiba di lokasi pemanggilan?',
                'answer' => 'Untuk wilayah perkotaan utama Jabodetabek, Bandung, Semarang, Solo, Surabaya, Jogja, dan Bandar Lampung, teknisi armada terdekat kami dapat tiba di lokasi dalam 25 hingga 40 menit setelah konfirmasi pesanan.',
                'is_featured_home' => false,
                'sort_order' => 13,
            ],
            [
                'cat' => 'cakupan-wilayah-dan-respon',
                'question' => 'Apakah Rootera melayani pemanggilan darurat 24 Jam di hari libur?',
                'answer' => 'Ya, layanan Customer Service dan armada teknisi piket Rootera Plumbing beroperasi 24 Jam Nonstop, termasuk pada hari Sabtu, Minggu, serta hari libur nasional.',
                'is_featured_home' => false,
                'sort_order' => 14,
            ],

            // 5. Layanan B2B & Kontrak Maintenance
            [
                'cat' => 'layanan-b2b-dan-kontrak-maintenance',
                'question' => 'Apa keuntungan membuat Kontrak Preventive Maintenance B2B dengan Rootera?',
                'answer' => 'Dengan kontrak pemeliharaan berkala B2B, bisnis Anda (seperti cafe, restoran, hotel, atau pabrik) akan terhindar dari risiko penyumbatan mendadak saat jam operasional sibuk. Anda mendapatkan diskon harga khusus, inspeksi berkala, prioritas penanganan darurat 24 jam, serta laporan audit sanitasi bulanan.',
                'is_featured_home' => false,
                'sort_order' => 15,
            ],
            [
                'cat' => 'layanan-b2b-dan-kontrak-maintenance',
                'question' => 'Bagaimana prosedur penawaran harga & pembuatan PKS untuk perusahaan?',
                'answer' => 'Tim Business Development kami akan melakukan kunjungan peninjauan lapangan (survei lokasi gratis), menganalisis gambar skema plumbing, lalu menerbitkan Surat Penawaran Harga resmi (SPH) beserta draf Perjanjian Kerja Sama (PKS).',
                'is_featured_home' => false,
                'sort_order' => 16,
            ],
            [
                'cat' => 'layanan-b2b-dan-kontrak-maintenance',
                'question' => 'Apakah Rootera berpengalaman menangani instalasi Grease Trap komersial?',
                'answer' => 'Ya, kami berpengalaman dalam pembersihan rutin, pengurasan sludge lemak pekat, serta descaling kerak lemak pada grease trap stainless maupun beton di ratusan tenant mall, cloud kitchen, dan jaringan resto nasional.',
                'is_featured_home' => false,
                'sort_order' => 17,
            ],

            // 6. Masalah Saluran Spesifik
            [
                'cat' => 'masalah-saluran-spesifik',
                'question' => 'Mengapa wastafel bak cuci piring sering mampet dan bau tidak sedap?',
                'answer' => 'Sumbatan wastafel dapur umumnya disebabkan oleh akumulasi sisa minyak goreng, lemak makanan, dan sisa bahan sabun yang membeku di dalam leher angsa (P-trap) serta dinding pipa. Lemak membeku membentuk lapisan kapur keras yang menyempitkan aliran air dan menimbulkan bau busuk.',
                'is_featured_home' => false,
                'sort_order' => 18,
            ],
            [
                'cat' => 'masalah-saluran-spesifik',
                'question' => 'Mengapa air got meluap kembali dari floor drain kamar mandi saat hujan?',
                'answer' => 'Kondisi meluap ini (backflow) biasanya disebabkan oleh penyumbatan pada pipa saluran pembuangan utama luar rumah menuju got publik, atau tidak adanya katup penahan air balik (Backflow Valve). Mesin Rootera dapat melancarkan saluran utama tersebut agar aliran air lancar kembali.',
                'is_featured_home' => false,
                'sort_order' => 19,
            ],
            [
                'cat' => 'masalah-saluran-spesifik',
                'question' => 'Apakah aman menggunakan soda api / bahan kimia pembersih pipa mampet?',
                'answer' => 'Sangat tidak disarankan. Soda api reaksi kimianya menghasilkan panas tinggi yang dapat menyebabkan pipa PVC melengkung, mengkerut, bahkan pecah. Selain itu, soda api yang mendingin di dalam pipa justru bisa membeku menjadi gumpalan batu yang makin menyumbat pipa.',
                'is_featured_home' => false,
                'sort_order' => 20,
            ],
        ];

        foreach ($faqs as $item) {
            $catModel = $cats->get($item['cat']);
            if (!$catModel) continue;

            $slug = Str::slug($item['question']);

            Faq::updateOrCreate(
                ['slug' => $slug],
                [
                    'faq_category_id' => $catModel->id,
                    'question' => $item['question'],
                    'answer' => $item['answer'],
                    'is_featured_home' => $item['is_featured_home'],
                    'sort_order' => $item['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
