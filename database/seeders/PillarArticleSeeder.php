<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class PillarArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contentHtml = <<<'HTML'
<p class="lead font-semibold text-slate-700 text-lg leading-relaxed">
Saat saluran wastafel dapur atau kloset kamar mandi mulai tersumbat, reaksi pertama sebagian besar pemilik rumah di Indonesia adalah membeli <strong>soda api (Natrium Hidroksida / NaOH)</strong>. Janji kemasan yang mengklaim dapat "melarutkan semua kotoran dalam hitungan menit" memang sangat menggoda. Namun, tahukah Anda bahwa penanganan darurat dengan soda api justru menjadi pemicu utama kerusakan total instalasi pipa di kemudian hari?
</p>

<div class="my-6 p-5 bg-amber-50 border-l-4 border-amber-500 rounded-r-2xl text-amber-900 font-medium">
<strong>⚠️ Peringatan Teknisi:</strong> Lebih dari 65% kasus pemanggilan darurat Rootera Plumbing akibat pipa bocor di bawah lantai disebabkan oleh korosi termal akibat penggunaan soda api berkali-kali.
</div>

<h2 id="featured-snippet-jawaban-soda-api">Apa yang Terjadi Saat Soda Api Disiram ke Saluran Pipa PVC?</h2>
<p>
Ketika soda api (NaOH) bercampur dengan air di dalam saluran pipa, terjadi reaksi kimia eksotermik (menghasilkan panas tinggi hingga melebihi 90°C). Suhu ekstrem ini dibarengi dengan perubahan zat lemak di dalam pipa menjadi sabun keras padat (proses saponifikasi) yang menyumbat pipa secara permanen.
</p>
<p>
Pipa PVC standar rumah tangga kelas D/AW umumnya memiliki titik lunak termal sekitar 60°C – 80°C. Reaksi panas soda api secara langsung melunakkan dinding pipa, merusak lem sambungan (fitting elbow), dan memicu deformasi bengkok yang memerangkap sisa kotoran lebih parah.
</p>

<h2>3 Bahaya Utama Soda Api bagi Instalasi Plumbing Rumah Anda</h2>

<h3>1. Melunakkan Pipa PVC dan Meluluhkan Lem Sambungan (Fitting)</h3>
<p>
Pipa PVC yang tersiram larutan soda api terkonsentrasi tinggi akan mengalami kerapuhan struktural. Panas eksotermik meluluhkan lem solvent semen pada elbow (sambungan L/T), yang mengakibatkan kebocoran tersembunyi di dalam dinding atau di bawah ubin lantai. Kebocoran ini sering kali baru disadari setelah atap lantai bawah lembab atau timbul rembesan bau tak sedap.
</p>

<h3>2. Reaksi Saponifikasi: Mengubah Lemak Menjadi Kerak Batu</h3>
<p>
Sisa minyak goreng dan lemak makanan di wastafel dapur mengandung asam lemak bebas. Ketika bertemu dengan alkali pekat seperti soda api, terjadi reaksi <em>saponifikasi</em> (pembentukan sabun keras). Bukannya larut, sisa minyak justru memadat menyerupai lilin keras/batu kapur yang mengeras di dinding dalam pipa. Kerak batu ini mustahil dibersihkan hanya dengan menyiram air panas biasa.
</p>

<h3>3. Mengkristal di Dalam Pipa (Pengerasan Soda Api Beku)</h3>
<p>
Jika jumlah air yang digunakan untuk membilas soda api kurang banyak, bubuk soda api akan mengendap di lekukan pipa trap (P-trap/S-trap). Dalam kurun waktu beberapa jam, endapan tersebut mengkristal dan mengeras seperti semen. Pipa yang semula mampet sebagian akhirnya tersumbat total 100%.
</p>

<blockquote>
"Soda api tidak pernah menghancurkan benda padat seperti plastik, rambut, atau tulang ikan. Ia hanya bereaksi terhadap lemak, namun efek samping pengerasan saponifikasinya jauh lebih merusak dibanding sumbatan aslinya." — <strong>Tim Engineering Rootera</strong>
</blockquote>

<h2>Solusi Aman Pembersihan Pipa Tanpa Soda Api &amp; Tanpa Bongkar</h2>
<p>
Untuk mengatasi saluran pipa mampet secara permanen dan aman tanpa merusak struktur bangunan, metode mekanis modern adalah standar emas industri plumbing internasional:
</p>

<ul>
  <li><strong>Pembersihan Mekanis Spiral Baja (Drain Snake Cable):</strong> Menggunakan kawat fleksibel baja berputar berkecepatan tinggi yang mampu mencacah gumpalan rambut dan menarik sumbatan tanpa menggores dinding pipa.</li>
  <li><strong>Teknologi Hydro-Jetting Tekanan Tinggi:</strong> Semprotan air bertekanan khusus hingga 150-200 bar yang mengikis habis lapisan kerak lemak saponifikasi sampai pipa bersih 100% seperti baru.</li>
  <li><strong>Kamera Inspeksi Endoskop (Rigid Camera Inspection):</strong> Melakukan audit visual kondisi dalam pipa sebelum dan sesudah pengerjaan untuk memastikan tidak ada celah keretakan.</li>
</ul>

<p>
Jika Anda mengalami kendala saluran mampet yang tak kunjung lancar, konsultasikan dengan profesional melalui <a href="/jasa-saluran-mampet" class="text-blue-900 font-extrabold underline hover:text-blue-700">Jasa Saluran Mampet Rootera Plumbing</a> untuk penanganan cepat tanpa pembongkaran keramik lantai rumah Anda.
</p>

<h2>FAQ: Pertanyaan Populer Seputar Soda Api &amp; Pipa Mampet</h2>

<div class="space-y-4 my-6">
  <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
    <h4 class="font-bold text-slate-900 text-sm mb-1">Q: Bagaimana jika soda api sudah terlanjur mengeras di dalam pipa?</h4>
    <p class="text-xs text-slate-600">A: Jangan menambah soda api atau bahan kimia cair lainnya karena akan mempertebal lapisan semen kristal. Segera hubungi teknisi berkeahlian mekanis untuk melakukan pencacahan atau pembersihan hydro-jetting bertekanan tinggi.</p>
  </div>

  <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
    <h4 class="font-bold text-slate-900 text-sm mb-1">Q: Berapa lama waktu pengerjaan pelancaran pipa dengan mesin flex-shaft Rootera?</h4>
    <p class="text-xs text-slate-600">A: Estimasi pengerjaan rata-rata membutuhkan waktu 30 hingga 60 menit bergantung pada panjang jalur pipa dan tingkat keparahan sumbatan lemak.</p>
  </div>

  <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
    <h4 class="font-bold text-slate-900 text-sm mb-1">Q: Apakah pengerjaan Rootera disertai dengan garansi?</h4>
    <p class="text-xs text-slate-600">A: Ya, setiap pengerjaan pembersihan pipa mampet Rootera Plumbing dilindungi oleh Garansi Resmi 30 Hari Bebas Mampet Ulang.</p>
  </div>
</div>
HTML;

        Article::updateOrCreate(
            ['slug' => 'kenapa-soda-api-bikin-pipa-mampet-makin-parah'],
            [
                'title'            => 'Kenapa Soda Api Justru Bikin Pipa Mampet Makin Parah? Bahaya dan Solusi Amannya',
                'excerpt'          => 'Banyak orang mengira soda api adalah solusi instan untuk wastafel macet. Padahal, reaksi kimianya bisa melelehkan pipa PVC dan membentuk kerak kapur yang membatu. Simak fakta lapangan dari teknisi Rootera.',
                'content'          => $contentHtml,
                'category'         => 'Tips Rumah',
                'post_type'        => 'article',
                'is_headline'      => true,
                'is_featured'      => false,
                'read_time'        => 5,
                'thumbnail'        => 'articles/bahaya-soda-api-pipa-mampet.webp',
                'author'           => 'Tim Ahli Rootera',
                'status'           => 'published',
                'published_at'     => now(),
                'meta_title'       => 'Bahaya Soda Api untuk Saluran Pipa PVC & Solusi Amannya | Rootera',
                'meta_description' => 'Ketahui bahaya menyiram soda api ke saluran pipa mampet. Dapatkan edukasi teknis pembersihan pipa tanpa bongkar keramik dari tim ahli Rootera Plumbing.',
                'views'            => 248,
            ]
        );
    }
}
