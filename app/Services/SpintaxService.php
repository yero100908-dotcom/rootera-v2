<?php

namespace App\Services;

class SpintaxService
{
    /**
     * Parse a spintax formatted string deterministically using a seed key.
     * Example input: "Jasa {pipa mampet|pelancar saluran|solusi air tersumbat} profesional"
     *
     * @param string $text
     * @param string $seedKey
     * @return string
     */
    public function parse(string $text, string $seedKey): string
    {
        $hash = crc32($seedKey);
        $counter = 0;

        while (str_contains($text, '{') && str_contains($text, '}')) {
            $prevText = $text;
            $text = preg_replace_callback('/\{([^{}]+)\}/', function ($matches) use ($hash, &$counter) {
                $options = explode('|', $matches[1]);
                if (empty($options)) {
                    return '';
                }

                // Deterministic index selection using pseudo-random shift based on seed & sequence counter
                $index = abs(($hash + ($counter * 2654435761)) % count($options));
                $counter++;

                return trim($options[$index]);
            }, $text);

            if ($text === $prevText) {
                break;
            }
        }

        return trim(str_replace(['{', '}'], '', $text));
    }

    /**
     * Generate dynamic Section Layout Order based on seed key.
     * Guaranteed consistent section order per URL with 4 distinct layout variations.
     */
    public function getSectionOrder(string $seedKey): array
    {
        $hash = abs(crc32($seedKey . '_layout'));
        $variant = $hash % 4;

        $middleBlocks = [
            0 => ['technical-context', 'pricing-estimator', 'value-props', 'multi-sector', 'local-coverage', 'media-showcase', 'comparison-table', 'b2b-corporate', 'faq-accordion', 'interlinking'],
            1 => ['pricing-estimator', 'technical-context', 'local-coverage', 'value-props', 'multi-sector', 'media-showcase', 'comparison-table', 'b2b-corporate', 'faq-accordion', 'interlinking'],
            2 => ['value-props', 'technical-context', 'pricing-estimator', 'multi-sector', 'local-coverage', 'media-showcase', 'b2b-corporate', 'comparison-table', 'faq-accordion', 'interlinking'],
            3 => ['technical-context', 'local-coverage', 'value-props', 'pricing-estimator', 'multi-sector', 'media-showcase', 'comparison-table', 'b2b-corporate', 'faq-accordion', 'interlinking'],
        ];

        return array_merge(['hero'], $middleBlocks[$variant], ['emergency-cta']);
    }

    /**
     * Generate dynamic Hero Headline for programmatic pages (8-12 variations).
     */
    public function generateHeroHeadline(string $categoryName, string $locationName, string $seedKey): string
    {
        if (str_contains(strtolower($categoryName), 'cctv') || str_contains(strtolower($categoryName), 'inspeksi')) {
            $pattern = "{Jasa Inspeksi Kamera Pipa CCTV|Spesialis CCTV Endoscope Pipa|Jasa Pemetaan Saluran Kamera CCTV} {di|Area|Wilayah|Kawasan} {locationName} - {Tanpa Bongkar Keramik|Akurat Presisi 98%|512Hz Sonde Locator|Hasil Rekaman Video HD}";
        } else {
            $pattern = "{{Jasa|Spesialis|Pusat|Layanan Utama|Ahli Pelancar|Tukang Profesional|Jasa Panggil} {categoryName} {di|Area|Wilayah|Kawasan} {locationName} - {Tuntas 100%|Respon Cepat 24 Jam|Bergaransi Resmi 30 Hari|Tanpa Bongkar Keramik|Pengerjaan Fleksibel Modern|Layanan Siaga 24 Jam}|{Spesialis Pelancaran|Penanganan Cepat} {categoryName} {locationName} {Terdekat & Bergaransi|Tanpa Merusak Lantai|Garansi Tuntas}}";
        }
        
        $text = str_replace(
            ['{categoryName}', '{locationName}'],
            [$categoryName, $locationName],
            $pattern
        );

        return $this->parse($text, $seedKey . '_headline');
    }

    /**
     * Generate dynamic Hero Subtitle / Intro paragraph (8-12 variations).
     */
    public function generateHeroSubtitle(string $categoryName, string $locationName, string $estimatedArrival, string $seedKey): string
    {
        $pattern = "{{Solusi terpercaya|Layanan darurat terdepan|Pilihan utama|Penanganan profesional|Layanan panggil cepat|Rekomendasi terbaik} untuk masalah {saluran air mampet|wastafel tersumbat|pipa pembuangan bermasalah|kloset & drain mampet|endapan lemak & kerak pipa} di kawasan <strong>{locationName}</strong>. {Dikerjakan secara mekanis tanpa bongkar paksa|Menggunakan teknologi modern rigid spiral & hydro jetting|Ditangani teknisi berpengalaman bersertifikat|Didukung garansi pengerjaan tuntas 100%|Proses pengerjaan cepat 1-2 jam tuntas} dengan estimasi waktu tiba teknisi <strong>{estimatedArrival}</strong>.|{Solusi praktis dan efisien|Solusi bebas ribet} mengatasi {categoryName} di <strong>{locationName}</strong>. Tim teknisi siaga meluncur dengan estimasi <strong>{estimatedArrival}</strong> membawa {peralatan spiral modern|mesin hydro-jetting|alat pembersih pipa canggih} tanpa merusak lantai.}";

        $text = str_replace(
            ['{categoryName}', '{locationName}', '{estimatedArrival}'],
            [$categoryName, $locationName, $estimatedArrival],
            $pattern
        );

        return $this->parse($text, $seedKey . '_subtitle');
    }

    /**
     * Generate dynamic Value Proposition Badges / Cards.
     */
    public function generateValueProps(string $locationShort, string $seedKey): array
    {
        $v1 = $this->parse("{Metode Modern Tanpa Bongkar|Pengerjaan Fleksibel Tanpa Merusak|Teknologi Spiral & Jetting|Pembersihan Pipa Presisi}", $seedKey . '_vp1');
        $d1 = $this->parse("{Mesin rigid spiral fleksibel melancarkan lemak beku & kerak tanpa merusak ubin.|Saluran dilancarkan secara mekanis tanpa perlu membongkar lantai keramik hunian.|Pembersihan kerak pipa PVC presisi tanpa risiko pipa melengkung atau bocor.|Teknologi pendorong rotary cable menjangkau sudut siku pipa hingga 30 meter.}", $seedKey . '_vpd1');

        $v2 = $this->parse("{Respons Cepat Standby Hub|Tim Siaga Terdekat|Tiba Sesuai Jadwal|Armada Posko Siaga 24 Jam}", $seedKey . '_vp2');
        $d2 = $this->parse("{Armada teknisi siaga di pos terdekat wilayah {$locationShort} siap meluncur cepat.|Layanan darurat 24 jam dengan penetapan jadwal fleksibel sesuai kebutuhan Anda.|Tim profesional melayani area {$locationShort} dengan jaminan waktu tempuh efisien.|Penetapan teknisi terdekat dari posko {$locationShort} untuk respon langsung di lokasi.}", $seedKey . '_vpd2');

        $v3 = $this->parse("{Garansi Residensial & B2B|Jaminan Pekerjaan Tuntas|Garansi Resmi 30 Hari|Perlindungan Garansi Resmi}", $seedKey . '_vp3');
        $d3 = $this->parse("{Dilengkapi garansi pengerjaan ulang gratis jika saluran kembali tersumbat.|Jaminan kualitas pengerjaan amanah oleh PT/CV resmi J&J Group.|Jaminan kepuasan pelanggan dengan perlindungan garansi pengerjaan resmi.|Garansi tuntas baru bayar untuk kepastian kenyamanan Anda di {$locationShort}.}", $seedKey . '_vpd3');

        $v4 = $this->parse("{Estimasi Biaya Transparan|Harga Jujur Tanpa Biaya Tersembunyi|Penawaran Biaya Masuk Akal|Tarif Flat & Transparan}", $seedKey . '_vp4');
        $d4 = $this->parse("{Penetapan harga transparan diawal dan pembayaran setelah hasil terbukti lancar.|Tanpa biaya tambahan tak terduga, penetapan biaya disepakati sebelum pengerjaan.|Sistem pembayaran fleksibel dan transparan untuk kenyamanan pelanggan di {$locationShort}.|Estimasi tarif terjangkau tanpa biaya tersembunyi pasca penanganan.}", $seedKey . '_vpd4');

        return [
            ['title' => $v1, 'desc' => $d1, 'icon' => '🛠️'],
            ['title' => $v2, 'desc' => $d2, 'icon' => '⚡'],
            ['title' => $v3, 'desc' => $d3, 'icon' => '🛡️'],
            ['title' => $v4, 'desc' => $d4, 'icon' => '🏷️'],
        ];
    }

    /**
     * Generate dynamic Area Technical Intro paragraph with Landmark Mesh integration.
     */
    public function generateAreaTechnicalIntro(string $categoryName, string $locationName, string $seedKey, array $landmarks = []): string
    {
        $landmarkText = !empty($landmarks) ? "meliputi kawasan " . implode(', ', array_slice($landmarks, 0, 4)) : "sekitar area " . $locationName;

        if (str_contains(strtolower($categoryName), 'cctv') || str_contains(strtolower($categoryName), 'inspeksi')) {
            $pattern = "{Kawasan <strong>{locationName}</strong> ({landmarkText}) memiliki tantangan infrastruktur instalasi pipa bawah lantai yang kompleks. {Layanan jasa cctv pipa <strong>{locationName}</strong>|Deteksi letak septic tank hilang & bak kontrol <strong>{locationName}</strong>|Pemetaan denah saluran paralon tanpa bongkar <strong>{locationName}</strong>} dari Rootera hadir menggunakan kamera endoscope visual HD IP68 &amp; Sonde Locator 512Hz untuk melacak titik kebocoran pipa dalam dinding serta retakan paralon secara presisi tanpa merusak struktur ubin.|Sebagai wilayah hunian &amp; gedung komersial di <strong>{locationName}</strong> ({landmarkText}), kebutuhan layanan inspeksi kamera CCTV pipa saluran air sangat krusial untuk menemukan titik amblas, penembusan akar pohon, dan sumber bau misterius tanpa membobol semen secara tebak-tebakan.}";
        } else {
            $pattern = "{Kawasan <strong>{locationName}</strong> ({landmarkText}) memiliki tingkat kepadatan hunian dan aktivitas bisnis yang tinggi.|Sebagai kawasan padat hunian dan komersial di <strong>{locationName}</strong> ({landmarkText}), kebutuhan sistem sanitasi lancar sangat krusial.} Masalah {categoryName} umumnya disebabkan oleh {penumpukan gumpalan lemak minyak beku|endapan sisa sabun dan rontokan rambut|sedimen pasir dan lumpur di bak kontrol|masuknya benda asing ke dalam saringan drain}. Tim teknisi Rootera menyiagakan peralatan {rigid spiral drain cleaner|hydro jetting tekanan tinggi|kamera inspeksi CCTV} untuk mengatasi mampet secara tuntas di area <strong>{locationName}</strong>.";
        }

        $text = str_replace(
            ['{categoryName}', '{locationName}', '{landmarkText}'],
            [$categoryName, $locationName, $landmarkText],
            $pattern
        );

        return $this->parse($text, $seedKey . '_tech_intro');
    }

    /**
     * Generate dynamic Guarantee Callout sentence.
     */
    public function generateGuaranteeCallout(string $locationShort, string $seedKey): string
    {
        $pattern = "{Layanan bergaransi resmi 30 hari pasca pengerjaan|Garansi pengerjaan ulang tuntas 100% tanpa biaya tambahan|Jaminan kualitas pekerjaan amanah oleh teknisi Rootera|Proteksi pengerjaan tuntas baru bayar dengan garansi 30 hari} untuk seluruh pelanggan di kawasan <strong>{locationShort}</strong>.";
        return $this->parse(str_replace('{locationShort}', $locationShort, $pattern), $seedKey . '_guarantee');
    }

    /**
     * Generate dynamic Transactional Meta Title (Target: 50-60 chars).
     */
    public function generateMetaTitle(string $categoryName, string $locationName, ?string $districtName, string $seedKey): string
    {
        $locationShort = $districtName ?: $locationName;

        if (str_contains(strtolower($categoryName), 'cctv') || str_contains(strtolower($categoryName), 'inspeksi')) {
            $pattern = "{Jasa Inspeksi Kamera Pipa CCTV {locationShort} - Rootera|Deteksi Pipa Kamera CCTV & Pelacak Saluran {locationShort} | Rootera|Jasa Pemetaan Pipa & CCTV Inspeksi {locationShort} - Rootera}";
        } else {
            $pattern = "{Jasa {categoryName} {locationShort} 24 Jam Tanpa Bongkar - Rootera|Spesialis {categoryName} {locationShort} 24 Jam Bergaransi - Rootera|Jasa Pelancar {categoryName} {locationShort} Tanpa Bongkar - Rootera|Tukang {categoryName} Terdekat {locationShort} Bergaransi - Rootera}";
        }

        $text = str_replace(
            ['{categoryName}', '{locationShort}'],
            [$categoryName, $locationShort],
            $pattern
        );

        $result = $this->parse($text, $seedKey . '_meta_title');
        
        if (mb_strlen($result) > 60) {
            $result = mb_strimwidth($result, 0, 58, '..');
        }

        return $result;
    }

    /**
     * Generate dynamic Transactional Meta Description (Target: 140-155 chars).
     */
    public function generateMetaDescription(string $categoryName, string $locationName, string $estimatedArrival, string $seedKey): string
    {
        if (str_contains(strtolower($categoryName), 'cctv') || str_contains(strtolower($categoryName), 'inspeksi')) {
            $pattern = "{Butuh inspeksi kamera CCTV pipa di {locationName}? Deteksi posisi pipa pecah, amblas & pelacak septic tank tersembunyi tanpa bongkar. File video HD MP4.|Jasa inspeksi visual kamera endoscope pipa saluran di {locationName}. Lacak lokasi sumbatan & titik retak akurat dengan Sonde 512Hz. Bukti rekaman video HD.}";
        } else {
            $pattern = "{Butuh jasa {categoryName} di {locationName}? Teknisi posko siaga terdekat meluncur cepat dalam {estimatedArrival} tanpa bongkar keramik. Garansi tuntas 30 hari.|Layanan pelancaran {categoryName} profesional di {locationName}. Menggunakan mesin rotary cable & hydro jetting tanpa membongkar lantai. Bergaransi 30 hari.|Solusi cepat {categoryName} tersumbat di area {locationName}. Dikerjakan teknisi berpengalaman 24 jam tanpa bongkar. Tuntas baru bayar & bergaransi resmi.}";
        }

        $text = str_replace(
            ['{categoryName}', '{locationName}', '{estimatedArrival}'],
            [$categoryName, $locationName, $estimatedArrival],
            $pattern
        );

        $result = $this->parse($text, $seedKey . '_meta_desc');

        if (mb_strlen($result) > 155) {
            $result = mb_strimwidth($result, 0, 152, '...');
        }

        return $result;
    }
}
