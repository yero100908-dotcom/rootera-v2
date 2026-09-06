<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds for Knowledge Base & Blog (All Pure Text Articles).
     */
    public function run(): void
    {
        // 1. Reset all existing articles to post_type = article and clear youtube_video_id
        Article::query()->update([
            'post_type'        => 'article',
            'youtube_video_id' => null,
            'video_embed_url'  => null,
        ]);

        $articles = [
            // ==========================================
            // PILAR 1: TIPS & SANITASI RUMAH
            // ==========================================
            [
                'title'            => 'Cara Mengatasi Bak Cuci Piring Mampet Akibat Lemak Membeku Tanpa Bongkar',
                'slug'             => 'cara-mengatasi-bak-cuci-piring-mampet-akibat-lemak-membeku',
                'category'         => 'Tips Rumah',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Endapan sisa minyak goreng dan lemak dapur sering membeku di leher angsa wastafel. Simak cara melancarkannya dengan aman tanpa membongkar pipa.',
                'content'          => '<h3>Mengapa Lemak Menjadi Musuh Utama Wastafel Dapur?</h3>
<p>Saat Anda mencuci piring atau peralatan masak yang berminyak, sisa lemak cair ikut terbilas ke dalam saluran pembuangan. Di dalam pipa PVC yang dingin dan tersembunyi di bawah lantai, minyak cair tersebut cepat membeku, menempel pada dinding pipa, dan menangkap sisa-sisa makanan lainnya hingga membentuk kerak lilin yang mengeras.</p>

<h3>3 Langkah Praktis Melancarkan Wastafel Berlemak</h3>
<ul>
    <li><strong>Siraman Air Panas + Sabun Cuci Piring Liquid:</strong> Tuangkan 100ml sabun cair pekat ke lubang wastafel, biarkan 15 menit agar melarutkan ikatan minyak, lalu siram perlahan dengan air panas.</li>
    <li><strong>Kombinasi Baking Soda dan Cuka Apel:</strong> Masukkan 1 cangkir baking soda disusul 1 cangkir cuka. Reaksi asam basa alami ini menghasilkan gelembung CO2 yang melonggarkan gumpalan lemak.</li>
    <li><strong>Pembersihan Mekanis dengan Rooter Spiral:</strong> Jika gumpalan berada lebih dari 2 meter di dalam pipa tanah, gunakan jasa teknisi rooter fleksibel yang efektif menghancurkan kerak lemak tanpa membongkar ubin.</li>
</ul>

<h4>Q: Apakah aman menyiram air mendidih ke dalam pipa PVC rumah?</h4>
<p>A: Menyiram air panas suam-suam kuku (sekitar 60-70°C) sangat aman. Namun hindari air mendidih 100°C yang disiram terus-menerus pada pipa PVC berkualitas rendah karena berisiko melembekkan sambungan lem pipa.</p>

<h4>Q: Berapa lama gumpalan lemak dapur biasanya menumpuk hingga pipa tersumbat total?</h4>
<p>A: Pada penggunaan rumah tangga normal, akumulasi lemak yang signifikan terjadi dalam 6 hingga 12 bulan jika tidak pernah dibersihkan secara berkala.</p>',
                'author'           => 'Tim Ahli Rootera',
                'status'           => 'published',
                'published_at'     => now()->subDays(2),
                'read_time'        => 5,
                'views'            => 840,
                'is_headline'      => true,
                'is_featured'      => false,
                'meta_title'       => 'Solusi Wastafel Dapur Mampet Berlemak Tanpa Bongkar | Rootera',
                'meta_description' => 'Cara praktis dan profesional melancarkan bak cuci piring wastafel mampet akibat lemak mengeras tanpa membongkar ubin dapur.',
            ],
            [
                'title'            => 'Panduan Lengkap Pelancaran Wastafel Dapur Tersumbat Lemak Pekat',
                'slug'             => 'panduan-lengkap-pelancaran-wastafel-dapur-tersumbat-lemak-pekat',
                'category'         => 'Tips Rumah',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Panduan komprehensif penanganan pipa dapur yang tertutup kerak lemak tebal menggunakan metode mekanis fleksibel tanpa merusak keramik.',
                'content'          => '<h3>Diagnosa Penumpukan Kerak Lemak di Pipa Dapur</h3>
<p>Pipa pembuangan wastafel dapur seringkali mengalami penurunan laju buang secara bertahap sebelum akhirnya mampet total. Hal ini ditandai dengan munculnya bunyi gelembung (gurgling) dan luapan air dari saringan bak cuci saat kran dinyalakan.</p>

<h3>Metode Penanganan Efektif:</h3>
<ul>
    <li><strong>Pemeriksaan P-Trap Leher Angsa:</strong> Buka tabung leher angsa di bawah sink dan bersihkan endapan lemak keras yang menumpuk.</li>
    <li><strong>Penggunaan Cable Auger Mekanis:</strong> Masukkan kawat spiral baja lentur untuk menghancurkan sumbatan di belokan pipa bawah lantai.</li>
    <li><strong>Pencegahan Rutin:</strong> Hindari membuang minyak jelantah langsung ke wastafel. Tampung minyak bekas di wadah terpisah sebelum dibuang.</li>
</ul>

<h4>Q: Berapa lama waktu yang dibutuhkan untuk melancarkan wastafel dapur dengan alat rooter?</h4>
<p>A: Proses pelancaran mekanis umumnya memakan waktu 30 hingga 45 menit tergantung tingkat kekerasan gumpalan lemak.</p>

<h4>Q: Apakah proses ini merusak atau membocorkan pipa PVC?</h4>
<p>A: Tidak, kabel spiral fleksibel didesain memutar mengikuti lekukan pipa tanpa merusak atau mengikis dinding pipa PVC.</p>',
                'author'           => 'Divisi Teknis Plumbing',
                'status'           => 'published',
                'published_at'     => now()->subDays(4),
                'read_time'        => 4,
                'views'            => 620,
                'is_headline'      => false,
                'is_featured'      => true,
                'meta_title'       => 'Panduan Pelancaran Wastafel Mampet Lemak Pekat | Rootera',
                'meta_description' => 'Panduan lengkap cara melancarkan saluran wastafel tersumbat kerak lemak pekat tanpa perlu membongkar saluran dapur.',
            ],
            [
                'title'            => 'Solusi Saluran Kamar Mandi Bau & Floor Drain Mampet Akibat Rambut',
                'slug'             => 'solusi-saluran-kamar-mandi-bau-and-floor-drain-mampet-akibat-rambut',
                'category'         => 'Tips Rumah',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Genangan air di kamar mandi tidak hanya membuat licin tetapi juga memicu bau tak sedap. Pelajari cara membersihkan gumpalan rambut di floor drain.',
                'content'          => '<h3>Penyebab Utama Floor Drain Menyumbat & Mengeluarkan Bau</h3>
<p>Rambut yang rontok saat mandi merupakan pengikat utama sisa sabun, daki kulit, dan endapan kapur air tanah. Ketika gumpalan ini tersangkut di leher angsa saluran floor drain, aliran air melambat dan bakteri anaerob berkembang biak memicu bau busuk.</p>

<h3>Langkah Pembersihan Mandiri:</h3>
<ul>
    <li>Angkat saringan floor drain dan gunakan kawat pemancing fleksibel untuk menarik gumpalan rambut.</li>
    <li>Bersihkan leher angsa penampung air dari sisa sabun dan endapan hitam.</li>
    <li>Tuangkan campuran air garam panas dan cuka untuk mengeliminasi bau menyengat.</li>
</ul>

<h4>Q: Mengapa bau got tetap keluar padahal floor drain sudah disiram pembersih lantai?</h4>
<p>A: Bau got naik karena air di dalam perangkap leher angsa (P-trap) menguap kering atau pipa perangkap mengalami kebocoran udara.</p>

<h4>Q: Bagaimana cara mencegah rambut masuk ke dalam pipa pembuangan?</h4>
<p>A: Pasang saringan tambahan berbahan jaring stainless steel micro-mesh di atas saringan floor drain bawaan.</p>',
                'author'           => 'Tim Ahli Rootera',
                'status'           => 'published',
                'published_at'     => now()->subDays(7),
                'read_time'        => 4,
                'views'            => 510,
                'is_headline'      => false,
                'is_featured'      => false,
                'meta_title'       => 'Cara Hilangkan Bau Floor Drain Kamar Mandi & Sumbatan Rambut | Rootera',
                'meta_description' => 'Solusi mudah mengatasi genangan air kamar mandi akibat gumpalan rambut dan cara mengeliminasi bau got dari saluran.',
            ],
            [
                'title'            => 'Cara Darurat Mengatasi Kloset Duduk Meluap & Mampet Secara Higienis',
                'slug'             => 'cara-darurat-mengatasi-kloset-duduk-meluap-and-mampet-secara-higienis',
                'category'         => 'Tips Rumah',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Panduan darurat penanganan toilet kloset meluap saat disiram. Pelajari langkah pertolongan pertama yang higienis dan aman.',
                'content'          => '<h3>Tindakan Cepat Saat Kloset Duduk Meluap</h3>
<p>Saat kloset disiram dan air kotor malah naik mendekati bibir kloset, kepanikan sering membuat pemilik rumah terus memencet tombol flush. Hal ini sangat keliru karena akan membuat air kotor meluber ke seluruh lantai kamar mandi.</p>

<h3>Langkah Pertolongan Pertama:</h3>
<ul>
    <li><strong>Matikan Suplai Air:</strong> Segera putar kran fleksibel di belakang tangki kloset searah jarum jam untuk menghentikan aliran pengisian air.</li>
    <li><strong>Gunakan Plunger Bertipe Flanged:</strong> Pastikan mangkuk karet plunger menutup sempurna lubang porselen kloset sebelum mendorong dengan tekanan stabil.</li>
    <li><strong>Hindari Menyiram Bahan Kimia Keras:</strong> Jangan menuang asam pekat karena dapat merusak lapisan porselen dan seal karet kloset.</li>
</ul>

<h4>Q: Mengapa tisu basah dilarang keras dibuang ke kloset duduk?</h4>
<p>A: Tisu basah terbuat dari serat sintetis tak terurai yang langsung tersangkut di lekukan leher angsa porselen kloset.</p>

<h4>Q: Kapan saya harus memanggil teknisi profesional untuk kloset mampet?</h4>
<p>A: Jika penggunaan plunger tidak membuahkan hasil dalam 5 menit, atau jika penyumbat berupa benda padat keras seperti mainan anak atau pembalut.</p>',
                'author'           => 'Divisi Teknis Plumbing',
                'status'           => 'published',
                'published_at'     => now()->subDays(10),
                'read_time'        => 5,
                'views'            => 730,
                'is_headline'      => false,
                'is_featured'      => false,
                'meta_title'       => 'Cara Mengatasi Kloset Duduk Meluap & Mampet Higienis | Rootera',
                'meta_description' => 'Panduan darurat mengatasi kloset toilet meluap dan mampet secara cepat, higienis, dan tanpa merusak porselen.',
            ],

            // ==========================================
            // PILAR 2: KOMERSIAL & INDUSTRI B2B
            // ==========================================
            [
                'title'            => 'Standar Perawatan Grease Trap Restoran & Cafe untuk Mencegah Mampet Mendadak',
                'slug'             => 'standar-perawatan-grease-trap-restoran-and-cafe-untuk-mencegah-mampet-mendadak',
                'category'         => 'Komersial & B2B',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Bisnis F&B sangat rentan terganggu akibat luapan bau dan air berlemak di dapur. Pelajari SOP perawatan grease trap stainless steel.',
                'content'          => '<h3>Tantangan Limbah Lemak Dapur Komersial</h3>
<p>Restoran dan cafe menghasilkan limbah minyak jenuh dalam jumlah besar setiap harinya. Tanpa sistem penangkap lemak (grease trap) yang terawat, limbah cair ini akan membeku di sepanjang jaringan pipa utama ruko dan melumpuhkan kegiatan operasional dapur.</p>

<h3>SOP Perawatan Rutin Grease Trap Restoran:</h3>
<ul>
    <li><strong>Pembersihan Keranjang Sisa Makanan (Basket Trap):</strong> Wajib dibersihkan setiap hari setelah jam tutup dapur.</li>
    <li><strong>Pengurasan Skimmer Lemak (Grease Layer):</strong> Dikuras minimal 2 hari sekali untuk mencegah tumpatan lemak ke kompartemen pembuangan.</li>
    <li><strong>Preventive Maintenance Pipa Utama:</strong> Flushing pembersihan mekanis 3 bulan sekali oleh teknisi berlangganan.</li>
</ul>

<h4>Q: Berapa kapasitas grease trap yang ideal untuk cafe atau restoran menengah?</h4>
<p>A: Untuk dapur dengan 2-3 bak cuci piring (sink), gunakan grease trap stainless steel berkapasitas minimal 60 hingga 100 liter.</p>

<h4>Q: Apakah Rootera Plumbing melayani kerjasama maintenance rutin B2B beserta Faktur Pajak PPN?</h4>
<p>A: Ya, sebagai bagian dari holding <strong>J&J Group</strong>, Rootera melayani kontrak kerja sama pemeliharaan berkala untuk corporate & F&B dengan kelengkapan faktur pajak resmi.</p>',
                'author'           => 'Corporate B2B Rootera',
                'status'           => 'published',
                'published_at'     => now()->subDays(3),
                'read_time'        => 6,
                'views'            => 920,
                'is_headline'      => false,
                'is_featured'      => true,
                'meta_title'       => 'Standar Perawatan Grease Trap Restoran & Cafe B2B | Rootera',
                'meta_description' => 'SOP pemeliharaan rutin grease trap dan pipa pembuangan dapur restoran agar bebas masalah mampet saat jam sibuk.',
            ],
            [
                'title'            => 'Panduan Teknis Pelancaran Drainase Gedung & Bak Kontrol Mall Terbuka',
                'slug'             => 'panduan-teknis-pelancaran-drainase-gedung-and-bak-kontrol-mall-terbuka',
                'category'         => 'Komersial & B2B',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Metode teknis pembersihan bak kontrol dan jaringan drainase utama pusat perbelanjaan menggunakan hydro-jetting tanpa mengganggu pengunjung.',
                'content'          => '<h3>Pengelolaan Drainase Skala Gedung Komersial</h3>
<p>Saluran pembuangan utama diameter 8-12 inci di kawasan pusat perbelanjaan dan gedung komersial sering menampung endapan lumpur, sisa pembetonan, dan limbah minyak padat dari puluhan tenant F&B.</p>

<h3>Prosedur Kerja Standar Industri:</h3>
<ul>
    <li><strong>Inspeksi Akses Bak Kontrol Utama:</strong> Pemetaan jalur drainase dari outlet gedung menuju riol kota.</li>
    <li><strong>Penembakan Hydro-Jetting High Pressure:</strong> Semburan air bertekanan hingga 300 Bar meluruhkan pasir dan kerak minyak secara merata.</li>
    <li><strong>Eksekusi Jam Operasional Khusus (Nocturnal Shift):</strong> Pengerjaan dilakukan pada malam hari setelah jam tutup gedung demi kenyamanan pengunjung.</li>
</ul>

<h4>Q: Apakah tekanan air hydro-jetting aman untuk jaringan pipa drainase beton lama?</h4>
<p>A: Sangat aman. Tekanan nozzle diatur presisi sesuai ketahanan material pipa untuk meluruhkan kerak tanpa mengikis struktur dinding pipa.</p>

<h4>Q: Berapa jauh jangkauan selang hydro-jetting industri Rootera?</h4>
<p>A: Unit hydro-jetting industri kami mampu melaju hingga kedalaman 50 meter dari titik penembakan.</p>',
                'author'           => 'Corporate B2B Rootera',
                'status'           => 'published',
                'published_at'     => now()->subDays(6),
                'read_time'        => 5,
                'views'            => 580,
                'is_headline'      => false,
                'is_featured'      => false,
                'meta_title'       => 'Panduan Pelancaran Drainase Mall & Gedung B2B | Rootera',
                'meta_description' => 'Penanganan teknis pelancaran drainase bak kontrol gedung komersial dan mall oleh tim profesional Rootera Plumbing.',
            ],
            [
                'title'            => 'Penanganan Pipa Buang Utama (Main Stack Pipe) Mampet pada Apartemen & Ruko',
                'slug'             => 'penanganan-pipa-buang-utama-main-stack-pipe-mampet-pada-apartemen-and-ruko',
                'category'         => 'Komersial & B2B',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Pipa tegak vertikal apartemen yang mampet berdampak fatal pada luapan air kotor di unit lantai bawah. Ini metode perbaikannya.',
                'content'          => '<h3>Risiko Saluran Pipa Tegak Vertikal (Main Stack Pipe)</h3>
<p>Pada gedung bertingkat dan kompleks ruko, seluruh buangan air kotor dari puluhan unit mengalir ke satu jalur pipa vertikal utama. Ketika terjadi sumbatan di lantai dasar, gaya gravitasi mendorong luapan air kotor keluar dari floor drain atau kloset unit di lantai terbawah.</p>

<h3>Solusi Tanpa Membongkar Wall Shaft Beton:</h3>
<ul>
    <li><strong>Inspeksi Kamera Endoskopi Tinggi:</strong> Menentukan letak titik presisi sumbatan dari akses cleanout terdekat.</li>
    <li><strong>Pembersihan Mekanis Berkecepatan Tinggi:</strong> Penggunaan rantai pembersih pipa rotary yang meluruhkan kerak minyak dan kapur di pipa vertikal.</li>
</ul>

<h4>Q: Mengapa unit lantai 1 sering menjadi korban luapan air saat pipa gedung mampet?</h4>
<p>A: Karena unit lantai 1 berada paling dekat dengan elbow belokan pipa vertikal ke horizontal menuju septic tank utama gedung.</p>

<h4>Q: Berapa lama estimasi pengerjaan pembersihan pipa stack vertikal gedung?</h4>
<p>A: Pengerjaan umumnya diselesaikan dalam waktu 2 hingga 4 jam per jalur stack pipe.</p>',
                'author'           => 'Corporate B2B Rootera',
                'status'           => 'published',
                'published_at'     => now()->subDays(12),
                'read_time'        => 5,
                'views'            => 670,
                'is_headline'      => false,
                'is_featured'      => false,
                'meta_title'       => 'Penanganan Pipa Stack Vertikal Apartemen Mampet B2B | Rootera',
                'meta_description' => 'Solusi perbaikan pipa buang utama vertikal mampet pada gedung bertingkat dan apartemen tanpa merusak shaft tembok.',
            ],
            [
                'title'            => 'SOP Perawatan & Inspeksi Pipa Limbah Domestik Pabrik & Kawasan Industri',
                'slug'             => 'sop-perawatan-and-inspeksi-pipa-limbah-domestik-pabrik-and-kawasan-industri',
                'category'         => 'Komersial & B2B',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Panduan standar perawatan saluran pembuangan limbah cair pabrik manufaktur untuk menjaga baku mutu lingkungan industri.',
                'content'          => '<h3>Standar Sanitasi Industri Berkelanjutan</h3>
<p>Pengelolaan limbah cair di area manufaktur dan fasilitas produksi kawasan industri memerlukan perhatian ekstra demi menjaga kelancaran alur produksi serta mematuhi aturan baku mutu lingkungan hidup.</p>

<h3>Poin Utama SOP Perawatan Saluran Industri:</h3>
<ul>
    <li><strong>Pencegahan Endapan Lumpur & Kimia:</strong> Pembersihan berkala pada bak penampung awal sebelum masuk ke sistem IPAL.</li>
    <li><strong>Penembakan Air Bertekanan Tinggi:</strong> Pembilasan rutin jalur pipa limbah cair dengan hydro-jetting berkapasitas debit air tinggi.</li>
    <li><strong>Kepatuhan Standar K3:</strong> Pengerjaan didukung perlengkapan K3 lengkap (APD, alat bantu napas, dan detektor gas beracun).</li>
</ul>

<h4>Q: Apakah Rootera siap melayani panggilan darurat 24 jam untuk area pabrik kawasan industri?</h4>
<p>A: Ya, tim respon darurat kami siap ditugaskan 24/7 di kawasan industri Jabodetabek, Banten, dan Jawa Tengah.</p>

<h4>Q: Dokumen pendukung apa yang disertakan dalam layanan B2B Rootera?</h4>
<p>A: Laporan inspeksi pengerjaan lengkap, berita acara serah terima (BAST), serta Faktur Pajak PPN resmi dari J&J Group.</p>',
                'author'           => 'Corporate B2B Rootera',
                'status'           => 'published',
                'published_at'     => now()->subDays(15),
                'read_time'        => 5,
                'views'            => 490,
                'is_headline'      => false,
                'is_featured'      => false,
                'meta_title'       => 'SOP Pipa Limbah Industri & Pabrik B2B | Rootera',
                'meta_description' => 'Panduan lengkap pemeliharaan rutin jaringan pipa limbah cair pabrik manufaktur dan kawasan industri dari tim Rootera.',
            ],

            // ==========================================
            // PILAR 3: MATERIAL & INSTALASI PIPA
            // ==========================================
            [
                'title'            => 'Komparasi Pipa PVC vs PPR vs HDPE: Mana yang Terbaik untuk Rumah & Industri?',
                'slug'             => 'komparasi-pipa-pvc-vs-ppr-vs-hdpe-mana-yang-terbaik-untuk-rumah-and-industri',
                'category'         => 'Material & Instalasi',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Bingung memilih jenis pipa untuk proyek bangunan Anda? Pahami perbedaan ketahanan material PVC, PPR, dan HDPE sebelum menginstalasi.',
                'content'          => '<h3>Mengenal Karakteristik Material Pipa Plumbing Modern</h3>
<p>Pemilihan material pipa yang tepat di awal pembangunan menentukan daya tahan sistem sanitasi bangunan Anda hingga puluhan tahun. Berikut adalah komparasi mendalam antara 3 jenis pipa populer:</p>

<h3>1. Pipa PVC (Polyvinyl Chloride)</h3>
<p>Sangat ideal untuk pipa pembuangan air kotor dan air hujan rumah tangga karena harganya yang ekonomis, licin, dan tahan terhadap korosi asam.</p>

<h3>2. Pipa PPR (Polypropylene Random)</h3>
<p>Sangat cocok untuk instalasi air panas dan dingin bertekanan tinggi (seperti sistem pemanas air water heater). Sambungan PPR menyatu secara homogen melalui teknik pemanasan (welding socket).</p>

<h3>3. Pipa HDPE (High-Density Polyethylene)</h3>
<p>Pipa fleksibel yang sangat kuat terhadap benturan dan pergerakan tanah. Sangat disarankan untuk instalasi jalur pipa air bersih utama di bawah tanah.</p>

<h4>Q: Pipa jenis apa yang paling tahan terhadap bahan kimia pembersih saluran?</h4>
<p>A: Pipa HDPE dan PPR memiliki ketahanan kimia paling tinggi dibanding PVC standar.</p>

<h4>Q: Mengapa pipa PVC sering bocor di bagian sambungan elbow?</h4>
<p>A: Kebocoran di sambungan PVC umumnya terjadi akibat pembersihan fitting yang kurang bersih sebelum pemberian lem pipa atau penurunan kualitas lem seiring waktu.</p>',
                'author'           => 'Divisi Teknis Plumbing',
                'status'           => 'published',
                'published_at'     => now()->subDays(5),
                'read_time'        => 6,
                'views'            => 890,
                'is_headline'      => false,
                'is_featured'      => true,
                'meta_title'       => 'Komparasi Pipa PVC vs PPR vs HDPE Lengkap | Rootera',
                'meta_description' => 'Panduan komparasi lengkap material pipa PVC, PPR, dan HDPE untuk instalasi air bersih & pembuangan rumah serta bangunan komersial.',
            ],
            [
                'title'            => 'Panduan Menghitung Kemiringan (Slope) Pipa Pembuangan Air Kotor Rumah',
                'slug'             => 'panduan-menghitung-kemiringan-slope-pipa-pembuangan-air-kotor-rumah',
                'category'         => 'Material & Instalasi',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Kemiringan pipa yang salah adalah penyebab utama pipa mudah mampet. Pahami kalkulasi slope ideal 1-2% untuk aliran air lancar.',
                'content'          => '<h3>Edukasi Teknis Instalasi Pipa Pembuangan</h3>
<p>Sudut kemiringan (slope gradient) saat memasang pipa pembuangan di bawah lantai rumah menentukan kelancaran pembilasan air dan sisa kotoran padat menuju septic tank.</p>

<h3>Rumus Kemiringan Standar Plumbing:</h3>
<ul>
    <li><strong>Kemiringan Ideal:</strong> 1% hingga 2% (penurunan 1 cm sampai 2 cm untuk setiap panjang pipa 1 meter).</li>
    <li><strong>Jika Slope Terlalu Datar (< 1%):</strong> Aliran air menjadi lambat, menyebabkan kotoran padat berhenti mengendap dan memicu sumbatan.</li>
    <li><strong>Jika Slope Terlalu Curam (> 3%):</strong> Air mengalir terlalu cepat mendahului kotoran padat yang tertinggal menempel di dinding pipa.</li>
</ul>

<h4>Q: Alat apa yang digunakan untuk mengukur kemiringan pipa saat instalasi?</h4>
<p>A: Gunakan waterpass digital atau laser level meter untuk memastikan kemiringan rata di sepanjang jalur pipa.</p>

<h4>Q: Berapa diameter pipa pembuangan yang ideal untuk lantai kamar mandi?</h4>
<p>A: Gunakan pipa PVC kelas AW berdiameter minimal 3 inci atau 4 inci untuk aliran air yang bebas genangan.</p>',
                'author'           => 'Divisi Teknis Plumbing',
                'status'           => 'published',
                'published_at'     => now()->subDays(8),
                'read_time'        => 5,
                'views'            => 650,
                'is_headline'      => false,
                'is_featured'      => false,
                'meta_title'       => 'Cara Menghitung Kemiringan Pipa Slope Ideal | Rootera',
                'meta_description' => 'Panduan menghitung sudut kemiringan slope pipa pembuangan air kotor agar tidak mudah mampet dan awet puluhan tahun.',
            ],
            [
                'title'            => 'Cara Tepat Instalasi Pompa Pendorong (Booster Pump) & Toren Air Bersih',
                'slug'             => 'cara-tepat-instalasi-pompa-pendorong-booster-pump-and-toren-air-bersih',
                'category'         => 'Material & Instalasi',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Tekanan air kran dan shower kurang kencang? Simak panduan pemasangan otomatis booster pump yang tepat pada jaringan toren rumah.',
                'content'          => '<h3>Mengatasi Masalah Tekanan Air Kran Rendah</h3>
<p>Aliran air kran atau shower yang kecil seringkali disebabkan oleh perbedaan ketinggian toren air yang kurang tinggi dari titik kran teratas. Pemasangan pompa pendorong (booster pump) otomatis menjadi solusi paling efektif untuk menjaga tekanan air stabil di setiap lantai.</p>

<h3>Skema Pemasangan Booster Pump yang Benar:</h3>
<ul>
    <li>Pasang pompa pendorong persis di bawah pipa keluaran (outlet) toren air utama.</li>
    <li>Gunakan automatic flow switch agar pompa hanya menyala saat ada kran yang dibuka.</li>
    <li>Pasang bypass valve untuk mengalirkan air secara gravitasi jika terjadi mati listrik.</li>
</ul>

<h4>Q: Apa perbedaan utama antara pompa sumur dangkal dengan booster pump khusus toren?</h4>
<p>A: Booster pump bekerja berdasarkan aliran air (flow switch) sehingga suaranya sangat halus dan tidak gampang cetak-cetek dibanding pompa biasa.</p>

<h4>Q: Berapa watt konsumsi listrik booster pump perumahan pada umumnya?</h4>
<p>A: Booster pump perumahan biasanya hemat energi, berdaya antara 60 Watt hingga 125 Watt.</p>',
                'author'           => 'Divisi Teknis Plumbing',
                'status'           => 'published',
                'published_at'     => now()->subDays(14),
                'read_time'        => 5,
                'views'            => 710,
                'is_headline'      => false,
                'is_featured'      => false,
                'meta_title'       => 'Cara Pasang Booster Pump Pompa Pendorong Toren | Rootera',
                'meta_description' => 'Panduan praktis pemasangan pompa pendorong booster pump toren air untuk meningkatkan tekanan kran dan shower rumah.',
            ],
            [
                'title'            => 'Teknik Penyambungan Pipa PVC & PPR Anti Bocor Bertekanan Tinggi',
                'slug'             => 'teknik-penyambungan-pipa-pvc-and-ppr-anti-bocor-bertekanan-tinggi',
                'category'         => 'Material & Instalasi',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Pelajari teknik penyambungan lem PVC yang benar serta pemanasan pipa PPR agar sambungan tidak lepas saat menerima tekanan air tinggi.',
                'content'          => '<h3>Edukasi Praktis Sambungan Pipa Anti Bocor</h3>
<p>Banyak kasus kebocoran pipa tersembunyi di dalam tembok disebabkan oleh kesalahan sepele saat pengolesan lem pipa atau suhu alat las PPR yang kurang tepat saat instalasi awal.</p>

<h3>Langkah Sambungan Pipa Profesional:</h3>
<ul>
    <li><strong>Prosedur Pipa PVC:</strong> Amplas halus ujung pipa, bersihkan dari debu tanah, oleskan solvent cement merata pada kedua sisi, lalu rekatkan tanpa memutar fitting.</li>
    <li><strong>Prosedur Pipa PPR:</strong> Panaskan mesin las socket fusion hingga mencapai suhu konstan 260°C. Masukkan pipa dan fitting secara sejajar selama 5-7 detik sebelum disambungkan.</li>
</ul>

<h4>Q: Berapa lama waktu pengeringan lem PVC yang aman sebelum dialiri air bertekanan?</h4>
<p>A: Biarkan sambungan lem mengering sempurna minimal 2 jam untuk air dingin, dan 24 jam untuk pengujian tekanan tinggi.</p>

<h4>Q: Bisakah pipa PPR disambungkan langsung dengan pipa PVC biasa?</h4>
<p>A: Bisa, namun wajib menggunakan fitting adaptor khusus berulir (male/female socket kuningan PPR).</p>',
                'author'           => 'Divisi Teknis Plumbing',
                'status'           => 'published',
                'published_at'     => now()->subDays(18),
                'read_time'        => 4,
                'views'            => 540,
                'is_headline'      => false,
                'is_featured'      => false,
                'meta_title'       => 'Teknik Sambungan Pipa PVC & PPR Anti Bocor | Rootera',
                'meta_description' => 'Panduan cara menyambungkan pipa PVC dan PPR dengan rapi, kuat, dan tahan tekanan air tinggi tanpa bocor.',
            ],

            // ==========================================
            // PILAR 4: TEKNOLOGI & SOLUSI MODERN
            // ==========================================
            [
                'title'            => 'Mengapa Hydro-Jetting Tekanan Tinggi Menjadi Solusi Terbaik Pipa Tersumbat?',
                'slug'             => 'mengapa-hydro-jetting-tekanan-tinggi-menjadi-solusi-terbaik-pipa-tersumbat',
                'category'         => 'Teknologi & Solusi',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Mengenal teknologi semprot air tekanan tinggi (Hydro-Jetting) yang mampu mengikis kerak lumpur, lemak, dan semen hingga 100% bersih.',
                'content'          => '<h3>Revolusi Pembersihan Saluran Pipa Modern</h3>
<p>Jika mesin rooter spiral cable mengandalkan daya kikis mekanis kawat baja, maka <strong>Hydro-Jetting</strong> memanfaatkan dorongan jet air bertekanan tinggi mencapai 200 hingga 300 Bar. Tekanan ini cukup kuat untuk merontokkan kerak paling mengeras sekalipun dan mengembalikannya bersih seperti pipa baru.</p>

<h3>Keunggulan Utama Hydro-Jetting:</h3>
<ul>
    <li><strong>Meluruhkan Kerak Lemak & Semen Padat:</strong> Semburan air 360° mengikis seluruh keliling dinding dalam pipa tanpa ada area yang terlewat.</li>
    <li><strong>Ramah Lingkungan:</strong> 100% menggunakan air bersih tanpa campuran bahan kimia berbahaya.</li>
    <li><strong>Efisien untuk Pipa Panjang:</strong> Mampu mendorong sisa buangan sejauh 50 meter hingga keluar ke bak kontrol kota.</li>
</ul>

<h4>Q: Apakah Hydro-Jetting aman untuk pipa paralon rumah tangga yang sudah lama?</h4>
<p>A: Sangat aman, karena tekanan air dapat diatur (calibrated pressure) sesuai dengan umur dan spesifikasi material pipa.</p>

<h4>Q: Apa bedanya Hydro-Jetting dengan mesin pembersih mobil (jet washer) biasa?</h4>
<p>A: Hydro-Jetting menggunakan debit air (flow rate) dan tekanan yang jauh lebih besar serta menggunakan nozzle khusus (reverse jetting nozzle) yang dapat berjalan sendiri di dalam pipa.</p>',
                'author'           => 'Tim Ahli Rootera',
                'status'           => 'published',
                'published_at'     => now()->subDays(1),
                'read_time'        => 5,
                'views'            => 1150,
                'is_headline'      => false,
                'is_featured'      => true,
                'meta_title'       => 'Keunggulan Hydro Jetting Tekanan Tinggi Pipa Mampet | Rootera',
                'meta_description' => 'Mengenal teknologi pelancaran pipa Hydro Jetting bertekanan tinggi yang ampuh meluruhkan kerak lemak dan semen tanpa bongkar.',
            ],
            [
                'title'            => 'Mengenal Cara Kerja Mesin Rooter Spiral Flexible untuk Melancarkan Pipa Mampet',
                'slug'             => 'mengenal-cara-kerja-mesin-rooter-spiral-flexible-untuk-melancarkan-pipa-mampet',
                'category'         => 'Teknologi & Solusi',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Prinsip kerja kawat fleksibel spiral menembus elbow 90 derajat pipa pembuangan untuk mengambil kain dan sampah penyebab tersumbat.',
                'content'          => '<h3>Solusi Tanpa Membongkar Keramik Rumah</h3>
<p>Mesin Rooter Flexible Cable merupakan alat pembersih mekanis berstandar internasional yang menjadi andalan utama Rootera Plumbing dalam menyelesaikan sumbatan pipa rumah tangga.</p>

<h3>Fitur Keunggulan Mesin Spiral Rooter:</h3>
<ul>
    <li><strong>Kabel Baja Otomatis Memutar:</strong> Berputar dengan kecepatan tinggi untuk mengikis endapan sabun dan minyak yang menempel di dinding pipa.</li>
    <li><strong>Mata Pisau Penarik Khusus:</strong> Dilengkapi auger pengambil yang mampu menggulung gumpalan rambut, kain lap, dan pembalut dari dalam pipa.</li>
    <li><strong>Akses Tanpa Dinding Rusak:</strong> Dimasukkan langsung melalui lubang afur atau floor drain tanpa membongkar keramik lantai.</li>
</ul>

<h4>Q: Apakah mesin spiral bisa mengambil benda keras seperti batu atau sendok yang masuk ke pipa?</h4>
<p>A: Ya, teknisi kami dapat mengganti mata penarik (head cutter) dengan tipe pencapit khusus untuk mengangkat benda keras.</p>

<h4>Q: Berapa garansi pengerjaan pelancaran pipa yang diberikan Rootera?</h4>
<p>A: Rootera memberikan garansi pengerjaan hingga 30 hari untuk memastikan saluran pipa Anda tetap lancar tanpa kendala.</p>',
                'author'           => 'Divisi Teknis Plumbing',
                'status'           => 'published',
                'published_at'     => now()->subDays(9),
                'read_time'        => 4,
                'views'            => 820,
                'is_headline'      => false,
                'is_featured'      => false,
                'meta_title'       => 'Cara Kerja Mesin Rooter Spiral Flexible Pipa Mampet | Rootera',
                'meta_description' => 'Penjelasan teknis cara kerja mesin rooter fleksibel kawat spiral melancarkan saluran mampet tanpa membongkar ubin lantai.',
            ],
            [
                'title'            => 'Deteksi Presisi Pipa Bocor & Tersumbat dengan Inspection Camera (CCTV Pipe)',
                'slug'             => 'deteksi-presisi-pipa-bocor-and-tersumbat-dengan-inspection-camera-cctv-pipe',
                'category'         => 'Teknologi & Solusi',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Jangan asal bongkar dinding! Gunakan teknologi kamera inspeksi endoskopi mikro untuk melihat kondisi bagian dalam pipa secara langsung.',
                'content'          => '<h3>Teknologi Diagnostik Pipa Tanpa Merusak Structure</h3>
<p>Sebelum melakukan tindakan perbaikan, diagnosa yang akurat sangat penting untuk menghemat biaya. Dengan <strong>CCTV Pipe Inspection Camera</strong>, teknisi Rootera dapat memasukkan kabel kamera tahan air beresolusi HD ke dalam jalur pipa pembuangan untuk memetakan kondisi fisik pipa secara transparan.</p>

<h3>Manfaat Inspeksi Kamera Pipa:</h3>
<ul>
    <li>Menemukan lokasi pasti pipa pecah, retak, atau melengkung di dalam tanah.</li>
    <li>Mengidentifikasi jenis benda penyumbat (apakah lemak, batu, akar pohon, atau sampah).</li>
    <li>Memberikan rekaman video jernih kepada pemilik rumah sebagai bukti pengerjaan.</li>
</ul>

<h4>Q: Berapa kedalaman maksimal kabel kamera inspeksi Rootera dapat masuk ke pipa?</h4>
<p>A: Kamera inspeksi portabel kami dilengkapi kabel dorong fleksibel sepanjang 30 meter dengan lampu LED illuminator super terang.</p>

<h4>Q: Apakah hasil rekaman video CCTV pipa dapat diminta oleh pelanggan?</h4>
<p>A: Tentu saja, hasil rekaman video HD akan diberikan secara gratis kepada pelanggan untuk dokumentasi aset bangunan.</p>',
                'author'           => 'Divisi Teknis Plumbing',
                'status'           => 'published',
                'published_at'     => now()->subDays(11),
                'read_time'        => 5,
                'views'            => 760,
                'is_headline'      => false,
                'is_featured'      => false,
                'meta_title'       => 'Deteksi Pipa Bocor & Mampet dengan Kamera CCTV | Rootera',
                'meta_description' => 'Manfaat teknologi kamera CCTV mikro untuk melacak posisi presisi penyumbatan dan kebocoran pipa tanpa merusak tembok.',
            ],
            [
                'title'            => 'Bahaya Kimia Soda Api pada Pipa Paralon PVC & Solusi Pembersihan Modern',
                'slug'             => 'bahaya-kimia-soda-api-pada-pipa-paralon-pvc-and-solusi-pembersihan-modern',
                'category'         => 'Teknologi & Solusi',
                'post_type'        => 'article',
                'youtube_video_id' => null,
                'video_embed_url'  => null,
                'excerpt'          => 'Edukasi penting! Pelajari bahaya reaksi panas kimia soda api yang merusak pipa PVC dan alternatif pembersihan aman secara mekanis.',
                'content'          => '<h3>Peringatan Penting Penggunaan Bahan Kimia Keras</h3>
<p>Penggunaan soda api (Caustic Soda) secara bebas sering dipromosikan sebagai solusi cepat pipa mampet. Namun, fakta teknis di lapangan menunjukkan bahwa soda api justru menjadi pemicu utama kerusakan fatal pada instalasi pipa rumah tangga.</p>

<h3>Mengapa Soda Api Sangat Berbahaya?</h3>
<ul>
    <li><strong>Reaksi Panas Eksotermik:</strong> Suhu reaksi kimia soda api saat bertemu air dapat melebihi 90°C yang melampaui batas toleransi panas pipa PVC standar perumahan.</li>
    <li><strong>Risiko Pembekuan Kimia:</strong> Jika gagal melancarkan sumbatan, soda api akan membeku dan mengeras seperti semen di dalam pipa, membuat sumbatan makin parah.</li>
    <li><strong>Bahaya Bagi Kesehatan:</strong> Uap kimia menyengat yang dihasilkan dapat mengiritasi mata dan saluran pernapasan.</li>
</ul>

<h4>Q: Apa yang harus dilakukan jika sudah terlanjur menyiram soda api dan pipa malah mampet total?</h4>
<p>A: Segera siram dengan air dingin berkapasitas banyak untuk mendinginkan suhu pipa, dan hindari memasukkan bahan kimia asam lain agar tidak memicu reaksi berantai.</p>

<h4>Q: Solusi apa yang aman menggantikan soda api?</h4>
<p>A: Gunakan jasa pelancaran mekanis spiral rooter Rootera yang 100% bebas dari bahan kimia berisiko.</p>',
                'author'           => 'Tim Ahli Rootera',
                'status'           => 'published',
                'published_at'     => now()->subDays(16),
                'read_time'        => 5,
                'views'            => 980,
                'is_headline'      => false,
                'is_featured'      => false,
                'meta_title'       => 'Bahaya Soda Api Merusak Pipa PVC Paralon | Rootera',
                'meta_description' => 'Edukasi bahaya reaksi kimia soda api pada pipa paralon PVC serta cara aman melancarkan pipa mampet tanpa bahan kimia.',
            ],
        ];

        foreach ($articles as $art) {
            Article::updateOrCreate(['slug' => $art['slug']], $art);
        }
    }
}
