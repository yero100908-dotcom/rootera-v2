<?php

namespace App\Services;

class DistrictVillageService
{
    /**
     * Complete mapping of districts to their actual kelurahan (sub-districts) & key local landmarks.
     */
    protected array $districtVillages = [
        // === JAKARTA SELATAN ===
        'cilandak' => ['Cilandak Barat', 'Lebak Bulus', 'Pondok Labu', 'Gandaria Selatan', 'Cipete Selatan', 'Pangeran Antasari'],
        'kebayoran-baru' => ['Senayan', 'Blok M', 'Gandaria Utara', 'Melawai', 'Petogogan', 'Pulo', 'Rawa Barat', 'Cipete Utara', 'Kramat Pela'],
        'kebayoran-lama' => ['Kebayoran Lama Utara', 'Kebayoran Lama Selatan', 'Pondok Pinang', 'Cipulir', 'Grogol Utara', 'Grogol Selatan'],
        'pasar-minggu' => ['Pejaten Barat', 'Pejaten Timur', 'Pasar Minggu', 'Kebagusan', 'Jati Padang', 'Ragunan', 'Cilandak Timur'],
        'jagakarsa' => ['Tanjung Barat', 'Lenteng Agung', 'Jagakarsa', 'Ciganjur', 'Srengseng Sawah', 'Cipedak'],
        'mampang-prapatan' => ['Kuningan Barat', 'Pela Mampang', 'Bangka', 'Tegal Parang', 'Mampang Prapatan'],
        'pancoran' => ['Kalibata', 'Rawa Duren', 'Duren Tiga', 'Cikoko', 'Pengadegan', 'Pancoran'],
        'tebet' => ['Tebet Barat', 'Tebet Timur', 'Kebon Baru', 'Bukit Duri', 'Manggarai', 'Manggarai Selatan', 'Menteng Dalam'],
        'setiabudi' => ['Setiabudi', 'Karet', 'Karet Semanggi', 'Karet Kuningan', 'Kuningan Timur', 'Menteng Atas', 'Passer Minggu'],
        'pesanggrahan' => ['Ulujami', 'Petukangan Utara', 'Petukangan Selatan', 'Pesanggrahan', 'Bintaro'],

        // === JAKARTA TIMUR ===
        'pasar-rebo' => ['Pekanbaru', 'Kalisari', 'Baru', 'Cijantung', 'Gedong'],
        'ciracas' => ['Cibubur', 'Kelapa Dua Wetan', 'Ciracas', 'Susukan', 'Rambutan'],
        'cipayung' => ['Lubang Buaya', 'Ceger', 'Cipayung', 'Munjul', 'Pondok Ranggon', 'Cilangkap', 'Bambu Apus', 'Setu'],
        'kramat-jati' => ['Kramat Jati', 'Batu Ampar', 'Balekambang', 'Kampung Tengah', 'Dukuh', 'Cawang', 'Cililitan'],
        'makasar' => ['Pinang Ranti', 'Makasar', 'Halim Perdanakusuma', 'Cipinang Melayu', 'Kebon Pala'],
        'duren-sawit' => ['Pondok Bambu', 'Duren Sawit', 'Pondok Kelapa', 'Pondok Kopi', 'Malaka Jaya', 'Malaka Sari', 'Klender'],
        'jatinegara' => ['Bali Mester', 'Kampung Melayu', 'Bidara Cina', 'Cipinang Cempedak', 'Rawa Bunga', 'Cipinang Muara', 'Cipinang Besar Utara', 'Cipinang Besar Selatan'],
        'cakung' => ['Cakung', 'Cakung Timur', 'Rawa Terate', 'Jatinegara', 'Penggilingan', 'Pulogebang', 'Ujung Menteng'],
        'pulogadung' => ['Kayu Putih', 'Jati', 'Rawamangun', 'Pisangan Timur', 'Cipinang', 'Jatinegara Kaum', 'Pulogadung'],
        'matraman' => ['Pisangan Baru', 'Utan Kayu Selatan', 'Utan Kayu Utara', 'Kayu Manis', 'Pal Meriam', 'Kebon Manggis'],

        // === JAKARTA BARAT ===
        'kembangan' => ['Kembangan Utara', 'Kembangan Selatan', 'Meruya Utara', 'Meruya Selatan', 'Srengseng', 'Joglo'],
        'kebon-jeruk' => ['Duri Kepa', 'Kedoya Selatan', 'Kedoya Utara', 'Kebon Jeruk', 'Sukabumi Utara', 'Kelapa Dua', 'Sukabumi Selatan'],
        'palmerah' => ['Slipi', 'Kota Bambu Utara', 'Kota Bambu Selatan', 'Jatipulo', 'Palmerah', 'Kemanggisan'],
        'grogol-petamburan' => ['Tomang', 'Grogol', 'Jelambar', 'Jelambar Baru', 'Wijaya Kusuma', 'Tanjung Duren Utara', 'Tanjung Duren Selatan'],
        'taman-sari' => ['Pinangsia', 'Glodok', 'Keagungan', 'Krukut', 'Taman Sari', 'Maphar', 'Tangki', 'Mangga Besar'],
        'tambora' => ['Tanah Sereal', 'Roa Malaka', 'Pekojan', 'Jembatan Lima', 'Krendang', 'Duri Utara', 'Duri Selatan', 'Kalianyar', 'Jembatan Besi', 'Angke'],
        'cengkareng' => ['Kedaung Kali Kelekar', 'Kapuk', 'Cengkareng Barat', 'Cengkareng Timur', 'Rawa Buaya', 'Duri Kosambi'],
        'kalideres' => ['Kamal', 'Tegal Alur', 'Pegadungan', 'Kalideres', 'Semenan'],

        // === JAKARTA PUSAT ===
        'menteng' => ['Menteng', 'Pegangsaan', 'Cikini', 'Gondangdia', 'Kebon Sirih'],
        'tanah-abang' => ['Bendungan Hilir', 'Karet Tengsin', 'Kebon Melati', 'Kebon Kacang', 'Kampung Bali', 'Petamburan', 'Gelora'],
        'gambir' => ['Gambir', 'Kebon Kelapa', 'Petojo Selatan', 'Duri Pulo', 'Petojo Utara', 'Cideng'],
        'sawah-besar' => ['Pasar Baru', 'Gunung Sahari Utara', 'Mangga Dua Selatan', 'Karang Anyar', 'Kartini'],
        'kemayoran' => ['Gunung Sahari Selatan', 'Kemayoran', 'Kebon Kosong', 'Harapan Mulya', 'Cempaka Baru', 'Sumur Batu', 'Serdang', 'Utan Panjang'],
        'cempaka-putih' => ['Cempaka Putih Timur', 'Cempaka Putih Barat', 'Rawasari'],
        'johar-baru' => ['Galur', 'Tanah Tinggi', 'Kampung Rawa', 'Johar Baru'],
        'senen' => ['Senen', 'Kwitang', 'Kenari', 'Paseban', 'Kramat', 'Bungur'],

        // === JAKARTA UTARA ===
        'penjaringan' => ['Penjaringan', 'Pluit', 'Pejagalan', 'Kapuk Muara', 'Kamal Muara'],
        'pademangan' => ['Pademangan Timur', 'Pademangan Barat', 'Ancol'],
        'tanjung-priok' => ['Tanjung Priok', 'Kebon Bawang', 'Sungai Bambu', 'Papanggo', 'Waras', 'Sunter Agung', 'Sunter Jaya'],
        'koja' => ['Koja', 'Rawa Badak Utara', 'Rawa Badak Selatan', 'Tugu Utara', 'Tugu Selatan', 'Lagoa'],
        'cilincing' => ['Kalibaru', 'Cilincing', 'Semper Barat', 'Semper Timur', 'Sukapura', 'Rorotan', 'Marunda'],
        'kelapa-gading' => ['Kelapa Gading Barat', 'Kelapa Gading Timur', 'Pegangsaan Dua'],

        // === BOGOR (KOTA & KABUPATEN) ===
        'bogor-selatan' => ['Batutulis', 'Bondongan', 'Cikaret', 'Cipaku', 'Empang', 'Lawanggintung', 'Mulyaharja', 'Pamoyanan'],
        'bogor-timur' => ['Baranangsiang', 'Katulampa', 'Sindangrasa', 'Sindangsari', 'Tajur', 'Sukasari'],
        'bogor-tengah' => ['Babakan', 'Babakanpasar', 'Cibogor', 'Ciwaringin', 'Gudang', 'Kebonkalapa', 'Paledang', 'Panaragan'],
        'bogor-barat' => ['Balungbangjaya', 'Bubulak', 'Cibadak', 'Cilendek Barat', 'Cilendek Timur', 'Curug', 'Loji', 'Margajaya', 'Pasirjaya', 'Pasirmuda', 'Semplak', 'Situgede'],
        'bogor-utara' => ['Bantarjati', 'Cibuluh', 'Ciluar', 'Ciparigi', 'Kedunghalangan', 'Tebet', 'Tanahbaru'],
        'tanah-sareal' => ['Cibadak', 'Kayumanis', 'Kebonpedes', 'Kedungbadak', 'Kedungjaya', 'Kedungwaringin', 'Kencana', 'Mekarwangi', 'Sukadamai', 'Sukaresmi', 'Tanahsareal'],
        'cibinong' => ['Cibinong', 'Cirimekar', 'Ciriung', 'Harapan Jaya', 'Karadenan', 'Nanggewer', 'Nanggewer Mekar', 'Pabuaran', 'Pondok Rajeg', 'Sukahati'],
        'sentul-city' => ['Babakan Madang', 'Citaringgul', 'Kadumangu', 'Karang Tengah', 'Sentul', 'Sumur Batu'],

        // === DEPOK ===
        'pancoran-mas' => ['Depok', 'Depok Jaya', 'Mampang', 'Pancoran Mas', 'Rangkapan Jaya', 'Rangkapan Jaya Baru'],
        'beji' => ['Beji', 'Beji Timur', 'Kemirimuka', 'Kukusan', 'Pondok Cina', 'Tanah Baru'],
        'sukmajaya' => ['Abadijaya', 'Baktijaya', 'Cisalak', 'Mekarjaya', 'Sukmajaya', 'Tirtojaya'],
        'cimanggis' => ['Cisalak Pasar', 'Curug', 'Harjamukti', 'Pasir Gunung Selatan', 'Tugu', 'Terapung'],
        'cinere' => ['Cinere', 'Gandul', 'Pangkalan Jati', 'Pangkalan Jati Baru'],
        'limo' => ['Grogol', 'Krukut', 'Limo', 'Meruyung'],
        'sawangan' => ['Bedahan', 'Cinangka', 'Pengasinan', 'Pasir Putih', 'Sawangan', 'Sawangan Baru'],

        // === BEKASI (KOTA & KABUPATEN) ===
        'bekasi-barat' => ['Kota Baru', 'Kranji', 'Medan Satria', 'Bintara', 'Bintara Jaya'],
        'bekasi-selatan' => ['Pekayon Jaya', 'Jatibening', 'Jatibening Baru', 'Jatiwaringin', 'Margajaya', 'Kayuringin Jaya'],
        'bekasi-timur' => ['Aren Jaya', 'Bekasi Jaya', 'Duren Jaya', 'Margahayu'],
        'bekasi-utara' => ['Harapan Baru', 'Harapan Jaya', 'Kaliabang Tengah', 'Marga Mulya', 'Perwira', 'Teluk Pucung'],
        'jatisampurna' => ['Jatikarya', 'Jatimurni', 'Jatiranggon', 'Jatisampurna', 'Jatisari'],
        'pondok-gede' => ['Jatibening', 'Jatibening Baru', 'Jaticempaka', 'Jatimakmur', 'Jatiwaringin'],
        'cikarang-selatan' => ['Ciantra', 'Cibatu', 'Pasirsari', 'Sukasejati', 'Serang', 'Kawasan EJIP', 'Kawasan MM2100'],

        // === TANGERANG & TANGERANG SELATAN ===
        'serpong' => ['BSD City', 'Cilenggang', 'Lengkong Gudang', 'Rawa Buntu', 'Serpong', 'Lengkong Gudang Timur'],
        'serpong-utara' => ['Alam Sutera', 'Jelupang', 'Lengkong Karya', 'Pakar', 'Pondok Jagung', 'Pondok Jagung Timur'],
        'pondok-aren' => ['Bintaro Jaya', 'Jurang Mangu Barat', 'Jurang Mangu Timur', 'Pondok Aren', 'Pondok Betung', 'Pondok Jaya', 'Pondok Kacang Barat', 'Pondok Kacang Timur', 'Pondok Pung'],
        'ciputat' => ['Cipatuh', 'Ciputat', 'Cipayung', 'Jombang', 'Sawah Baru', 'Sawah Besar', 'Serua', 'Serua Indah'],
        'ciputat-timur' => ['Cireundeu', 'Pisangan', 'Pondok Ranji', 'Rempoa', 'Rengas'],
        'pamulang' => ['Bambu Apus', 'Benda Baru', 'Kedaung', 'Pamulang Barat', 'Pamulang Timur', 'Pondok Benda', 'Pondok Cabe Ilir', 'Pondok Cabe Udik'],
        'karawaci' => ['Bojong Jaya', 'Bugel', 'Empang Raya', 'Karawaci', 'Karawaci Baru', 'Margasari', 'Nambo Jaya', 'Nusa Jaya', 'Pabuaran', 'Pabuaran Tumpeng', 'Pasar Baru', 'Sukajadi'],
        'tangerang' => ['Babakan', 'Buaran Indah', 'Cikokol', 'Kelapa Indah', 'Suka Asih', 'Sukarasa', 'Sukasari'],

        // === SEMARANG ===
        'banyumanik' => ['Pudakpayung', 'Gedawang', 'Jabungan', 'Padangsari', 'Banyumanik', 'Srondol Wetan', 'Srondol Kulon', 'Sumurboto', 'Ngesrep'],
        'candisari' => ['Candi', 'Jatingaleh', 'Karanganyar Gunung', 'Jomblang', 'Kaliwiru', 'Tegalsari', 'Wonotingal'],
        'semarang-selatan' => ['Bulustalan', 'Barusari', 'Randusari', 'Mugassari', 'Pleburan', 'Wonodri', 'Peterongan', 'Lamper Kidul', 'Lamper Tengah', 'Lamper Lor'],
        'semarang-barat' => ['Krobokan', 'Tawangmas', 'Tawangsari', 'Pusponjolo', 'Cabean', 'Bongsari', 'Manyaran'],
        'pedurungan' => ['Pedurungan Kidul', 'Pedurungan Lor', 'Pedurungan Tengah', 'Penggaron Kidul', 'Tlogosari Kulon', 'Tlogosari Wetan'],
        'gajahmungkur' => ['Sampangan', 'Bendan Ngisor', 'Bendan Duwur', 'Gajahmungkur', 'Karangrejo', 'Petompon', 'Lempongsari'],

        // === BANDAR LAMPUNG ===
        'kedaton' => ['Kedaton', 'Penengahan', 'Sukamenanti', 'Surabaya', 'Tegalsari', 'Kampung Baru'],
        'rajabasa' => ['Rajabasa', 'Rajabasa Indah', 'Rajabasa Jaya', 'Rajabasa Pemuka', 'Rajabasa Raya'],
        'tanjung-karang-pusat' => ['Durian Payung', 'Gotong Royong', 'Kaliawi', 'Palapa', 'Pasir Gintung', 'Pelita'],
        'tanjung-karang-timur' => ['Kelapa Tiga', 'Kota Baru', 'Sawah Brebes', 'Sawah Lama', 'Tebing Tinggi'],
        'sukarame' => ['Sukarame', 'Sukarame Baru', 'Way Dadi', 'Way Dadi Baru', 'Korpri Jaya', 'Korpri Raya'],
        'enggal' => ['Enggal', 'Pelita', 'Rawa Laut', 'Tanjung Karang', 'Gunung Sari']
    ];

    /**
     * Get real sub-districts / kelurahan or generate intelligent fallbacks.
     */
    public function getVillagesForDistrict(?string $districtSlug, string $citySlug, string $fallbackName): array
    {
        if (!empty($districtSlug)) {
            $slugKey = strtolower(trim($districtSlug));
            if (isset($this->districtVillages[$slugKey])) {
                return $this->districtVillages[$slugKey];
            }
        }

        // Intelligent Fallback generation without using other district names
        $baseName = !empty($fallbackName) ? $fallbackName : 'Wilayah';
        return [
            "Pusat Area {$baseName}",
            "Kelurahan {$baseName} Utama",
            "Kawasan Perumahan {$baseName}",
            "Jalan Raya Utama {$baseName}",
            "Kawasan Bisnis {$baseName}",
            "Sektor Residensial {$baseName}"
        ];
    }
}
