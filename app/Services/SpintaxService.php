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

        return preg_replace_callback('/\{([^{}]+)\}/', function ($matches) use ($hash, &$counter) {
            $options = explode('|', $matches[1]);
            if (empty($options)) {
                return '';
            }

            // Deterministic index selection using pseudo-random shift based on seed & sequence counter
            $index = abs(($hash + ($counter * 2654435761)) % count($options));
            $counter++;

            return trim($options[$index]);
        }, $text);
    }

    /**
     * Generate dynamic Hero Headline for programmatic pages.
     */
    public function generateHeroHeadline(string $categoryName, string $locationName, string $seedKey): string
    {
        $pattern = "{Jasa|Spesialis|Ahli|Layanan Utama} {categoryName} di {locationName} - {Tuntas 100%|Respon Cepat 24 Jam|Bergaransi Resmi|Tanpa Bongkar}";
        $text = str_replace(
            ['{categoryName}', '{locationName}'],
            [$categoryName, $locationName],
            $pattern
        );

        return $this->parse($text, $seedKey . '_headline');
    }

    /**
     * Generate dynamic Hero Subtitle / Intro paragraph.
     */
    public function generateHeroSubtitle(string $categoryName, string $locationName, string $estimatedArrival, string $seedKey): string
    {
        $pattern = "{Solusi terpercaya|Layanan darurat terdepan|Pilihan utama|Penanganan profesional} untuk masalah {saluran air mampet|wastafel tersumbat|pipa pembuangan bermasalah|kloset & drain mampet} di kawasan <strong>{locationName}</strong>. {Dikerjakan secara mekanis tanpa bongkar paksa|Menggunakan teknologi modern rigid spiral & hydro jetting|Ditangani teknisi berpengalaman bersertifikat|Didukung garansi pengerjaan tuntas 100%} dengan estimasi tiba teknisi <strong>{estimatedArrival}</strong>.";

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
        $v1 = $this->parse("{Metode Modern Tanpa Bongkar|Pengerjaan Fleksibel Tanpa Merusak|Teknologi Spiral Cables}", $seedKey . '_vp1');
        $d1 = $this->parse("{Mesin rigid spiral fleksibel melancarkan lemak beku & kerak tanpa merusak ubin.|Saluran dilancarkan secara mekanis tanpa perlu membongkar lantai keramik hunian.|Pembersihan kerak pipa PVC presisi tanpa risiko pipa melengkung atau bocor.}", $seedKey . '_vpd1');

        $v2 = $this->parse("{Respons Cepat Standby Hub|Tim Siaga Terdekat|Tiba Sesuai Jadwal}", $seedKey . '_vp2');
        $d2 = $this->parse("{Armada teknisi siaga di pos terdekat wilayah {$locationShort} siap meluncur cepat.|Layanan darurat 24 jam dengan penetapan jadwal fleksibel sesuai kebutuhan Anda.|Tim profesional melayani area {$locationShort} dengan jaminan waktu tempuh efisien.}", $seedKey . '_vpd2');

        $v3 = $this->parse("{Garansi Resensial & B2B|Jaminan Pekerjaan Tuntas|Garansi Resmi 30 Hari}", $seedKey . '_vp3');
        $d3 = $this->parse("{Dilengkapi garansi pengerjaan ulang gratis jika saluran kembali tersumbat.|Jaminan kualitas pengerjaan amanah oleh PT/CV resmi J&J Group.|Jaminan kepuasan pelanggan dengan perlindungan garansi pengerjaan resmi.}", $seedKey . '_vpd3');

        $v4 = $this->parse("{Estimasi Biaya Transparan|Harga Jujur Tanpa Biaya Tersembunyi|Penawaran Biaya Masuk Akal}", $seedKey . '_vp4');
        $d4 = $this->parse("{Penetapan harga transparan diawal dan pembayaran setelah hasil terbukti lancar.|Tanpa biaya tambahan tak terduga, penetapan biaya disepakati sebelum pengerjaan.|Sistem pembayaran fleksibel dan transparan untuk kenyamanan pelanggan di {$locationShort}.}", $seedKey . '_vpd4');

        return [
            ['title' => $v1, 'desc' => $d1, 'icon' => '🛠️'],
            ['title' => $v2, 'desc' => $d2, 'icon' => '⚡'],
            ['title' => $v3, 'desc' => $d3, 'icon' => '🛡️'],
            ['title' => $v4, 'desc' => $d4, 'icon' => '🏷️'],
        ];
    }

    /**
     * Generate dynamic Area Technical Intro paragraph.
     */
    public function generateAreaTechnicalIntro(string $categoryName, string $locationName, string $seedKey): string
    {
        $pattern = "Kawasan <strong>{locationName}</strong> memiliki tingkat kepadatan hunian dan aktivitas bisnis yang tinggi. Masalah {categoryName} umumnya disebabkan oleh {penumpukan gumpalan lemak minyak beku|endapan sisa sabun dan rontokan rambut|sedimen pasir dan lumpur di bak kontrol|masuknya benda asing ke dalam saringan drain}. Tim teknisi Rootera menyiagakan peralatan {rigid spiral drain cleaner|hydro jetting tekanan tinggi|kamera inspeksi CCTV} untuk mengatasi mampet secara tuntas di area <strong>{locationName}</strong>.";

        $text = str_replace(
            ['{categoryName}', '{locationName}'],
            [$categoryName, $locationName],
            $pattern
        );

        return $this->parse($text, $seedKey . '_tech_intro');
    }
}
