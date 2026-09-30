<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'media_type',
        'thumbnail_path',
        'media_file_path',
        'external_media_url',
        'before_image_path',
        'location_tag',
        'related_service_url',
        'description',
        'tool_used',
        'pipe_specs',
        'pipe_length',
        'completion_time',
        'warranty_days',
        'cost_estimate',
        'technical_diagnosis',
        'is_featured',
        'is_active',
        'sort_order',
        'published_at',
    ];

    protected $casts = [
        'is_featured'   => 'boolean',
        'is_active'     => 'boolean',
        'warranty_days' => 'integer',
        'cost_estimate' => 'decimal:2',
        'published_at'  => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gallery) {
            if (empty($gallery->slug)) {
                $gallery->slug = Str::slug($gallery->title);
            }
            if (empty($gallery->published_at)) {
                $gallery->published_at = now();
            }
        });

        static::updating(function ($gallery) {
            if ($gallery->isDirty('title') && empty($gallery->slug)) {
                $gallery->slug = Str::slug($gallery->title);
            }
        });
    }

    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'residential'      => 'Rumah Tinggal',
            'commercial_resto' => 'Restoran & Kafe',
            'commercial_b2b'   => 'Gedung & Pabrik',
            'cctv_inspection'  => 'Inspeksi CCTV',
            'tools_equipment'  => 'Alat & Hydro-Jetting',
            'team_action'      => 'Tim & Lapangan',
            'before_after'     => 'Before & After',
            default            => ucfirst(str_replace('_', ' ', $this->category ?? 'Umum')),
        };
    }

    protected function resolveAssetUrl(?string $rawPath, string $fallback = 'assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-desktop.webp'): string
    {
        if (empty($rawPath)) {
            return asset($fallback);
        }

        if (Str::startsWith($rawPath, ['http://', 'https://'])) {
            if (!str_contains($rawPath, 'rooteraplumbing')) {
                return $rawPath;
            }
            $parsed = parse_url($rawPath, PHP_URL_PATH);
            if ($parsed) {
                $rawPath = ltrim($parsed, '/');
            }
        }

        $cleanPath = ltrim($rawPath, '/');

        // 1. Direct public path check
        if (file_exists(public_path($cleanPath))) {
            return asset($cleanPath);
        }

        // 2. Storage prefix check
        if (!Str::startsWith($cleanPath, 'storage/')) {
            $storagePath = 'storage/' . $cleanPath;
            if (file_exists(public_path($storagePath))) {
                return asset($storagePath);
            }
        }

        // 3. Images prefix & dokumentasi check
        if (!Str::startsWith($cleanPath, 'images/')) {
            $imagesPath = 'images/' . $cleanPath;
            if (file_exists(public_path($imagesPath))) {
                return asset($imagesPath);
            }
            $dokumentasiPath = 'images/dokumentasi/' . basename($cleanPath);
            if (file_exists(public_path($dokumentasiPath))) {
                return asset($dokumentasiPath);
            }
        }

        // 4. Fallback check for storage/app/public physical location
        $appPublicPath = storage_path('app/public/' . ltrim(preg_replace('#^storage/#', '', $cleanPath), '/'));
        if (file_exists($appPublicPath)) {
            return asset('storage/' . ltrim(preg_replace('#^storage/#', '', $cleanPath), '/'));
        }

        return asset($fallback);
    }

    public function getDisplayThumbnailAttribute(): string
    {
        if (!empty($this->thumbnail_path)) {
            return $this->resolveAssetUrl($this->thumbnail_path, 'assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-desktop.webp');
        }
        if (!empty($this->media_file_path)) {
            return $this->resolveAssetUrl($this->media_file_path, 'assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-desktop.webp');
        }
        if (!empty($this->before_image_path)) {
            return $this->resolveAssetUrl($this->before_image_path, 'images/JnJ.jpeg');
        }
        return asset('assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-desktop.webp');
    }

    public function getDisplayMediaAttribute(): string
    {
        if ($this->external_media_url) {
            return $this->external_media_url;
        }
        if ($this->media_file_path) {
            return $this->resolveAssetUrl($this->media_file_path, 'assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-desktop.webp');
        }
        return $this->display_thumbnail;
    }

    public function getDisplayBeforeImageAttribute(): ?string
    {
        if (!$this->before_image_path) {
            return null;
        }
        return $this->resolveAssetUrl($this->before_image_path, 'images/JnJ.jpeg');
    }

    /**
     * Get local showcases with hierarchical fallback from 90+ real gallery records.
     */
    public static function getLocalShowcases(?int $cityId = null, ?int $districtId = null, int $limit = 3)
    {
        $city = $cityId ? \App\Models\City::find($cityId) : null;
        $district = $districtId ? \App\Models\District::find($districtId) : null;

        $results = collect();

        // 1. Match by District location_tag
        if ($district) {
            $districtName = $district->name;
            $matched = static::where('is_active', true)
                ->where('location_tag', 'like', "%{$districtName}%")
                ->latest('published_at')
                ->latest('id')
                ->take($limit)
                ->get();

            foreach ($matched as $g) {
                $g->is_fallback = false;
                $results->push($g);
            }
        }

        // 2. Match by City location_tag
        if ($results->count() < $limit && $city) {
            $existingIds = $results->pluck('id')->toArray();
            $cityName = $city->name;
            $matched = static::where('is_active', true)
                ->whereNotIn('id', $existingIds)
                ->where('location_tag', 'like', "%{$cityName}%")
                ->latest('published_at')
                ->latest('id')
                ->take($limit - $results->count())
                ->get();

            foreach ($matched as $g) {
                $g->is_fallback = $district ? true : false;
                $results->push($g);
            }
        }

        // 3. Fallback to featured active galleries
        if ($results->count() < $limit) {
            $existingIds = $results->pluck('id')->toArray();
            $featured = static::where('is_active', true)
                ->whereNotIn('id', $existingIds)
                ->where('is_featured', true)
                ->latest('published_at')
                ->latest('id')
                ->take($limit - $results->count())
                ->get();

            foreach ($featured as $g) {
                $g->is_fallback = ($district || $city) ? true : false;
                $results->push($g);
            }
        }

        // 4. Ultimate fallback to active galleries
        if ($results->count() < $limit) {
            $existingIds = $results->pluck('id')->toArray();
            $general = static::where('is_active', true)
                ->whereNotIn('id', $existingIds)
                ->latest('published_at')
                ->latest('id')
                ->take($limit - $results->count())
                ->get();

            foreach ($general as $g) {
                $g->is_fallback = ($district || $city) ? true : false;
                $results->push($g);
            }
        }

        return $results;
    }

    public function getToolsUsedAttribute(): array
    {
        return match($this->category) {
            'cctv_inspection' => [
                ['name' => 'Kamera CCTV Inspeksi Pipa HD 1080p', 'desc' => 'Kamera endoskopi waterproof dengan lampu LED adjustable untuk melacak titik retakan & lokasi pasti sumbatan.'],
                ['name' => 'Kabel Flex Push Rod 30 Meter', 'desc' => 'Kabel dorong fleksibel presisi tinggi yang dapat menjangkau lekukan pipa paralon 2-8 inci.'],
                ['name' => 'Monitor Display Digital Real-Time', 'desc' => 'Layar visual langsung untuk menampilkan rekaman kondisi dalam pipa kepada klien.']
            ],
            'commercial_resto' => [
                ['name' => 'Mesin Spiral Rotary Ridgid K-50', 'desc' => 'Mesin pemutar kabel baja berkekuatan tinggi untuk menghancurkan gumpalan lemak beku dapur resto.'],
                ['name' => 'Scraper Head & Bulb Auger', 'desc' => 'Mata pisau khusus pengikis sisa endapan minyak goreng yang menempel di dinding pipa.'],
                ['name' => 'Pembersih High-Pressure Flush', 'desc' => 'Penyemprotan air bertekanan tinggi untuk membilas sisa kerak lemak hingga saluran 100% bersih.']
            ],
            'commercial_b2b' => [
                ['name' => 'Rig Mesin Spiral Heavy Duty Industrial', 'desc' => 'Unit pembersih pipa skala besar untuk diameter 4 hingga 12 inci pada jaringan gedung & pabrik.'],
                ['name' => 'Hydro Jetting High Pressure System', 'desc' => 'Sistem pembersih air bertekanan hingga 300 bar untuk mengikis sedimen lumpur & limbah cair industri.'],
                ['name' => 'APD K3 Steril Standard Industri', 'desc' => 'Perlengkapan keselamatan lengkap (helm, sarung tangan heavy-duty, boot, masker) sesuai standar K3.']
            ],
            default => [
                ['name' => 'Mesin Cable Spiral Rotary Ridgid', 'desc' => 'Alat pelancar mekanis tanpa bongkar ubin yang aman untuk semua jenis pipa PVC & paralon.'],
                ['name' => 'Mata Pisau Auger Khusus Saringan', 'desc' => 'Kepala pemotong fleksibel penarik rontokan rambut, tisu, dan endapan sabun.'],
                ['name' => 'Perlengkapan Sanitasi & APD Teknisi', 'desc' => 'Garansi higienis dan pengerjaan rapi tanpa mengotori area lantai lokasi Anda.']
            ]
        };
    }

    public function getProblemStatementAttribute(): string
    {
        if (!empty($this->description)) {
            return $this->description;
        }
        return 'Telah terjadi kemampetan total pada saluran pipa pembuangan utama yang mengakibatkan air meluap dan menghambat aktivitas harian. Pembekuan kerak lemak, endapan sabun mengeras, serta sisa kotoran menumpuk di belokan paralon sehingga debit pembuangan mati total.';
    }

    public function getSolutionAndActionAttribute(): string
    {
        return 'Tim teknisi profesional Rootera Plumbing menerjunkan alat mekanis modern tanpa membongkar struktur bangunan. Menggunakan mesin spiral rotary kabel baja lentur yang berputar dengan presisi tinggi, penyumbatan dihancurkan dari dalam. Dilanjutkan dengan pembilasan (flushing) debit air maksimum hingga aliran pipa mengalir lancar kembali 100% dan teruji bergaransi.';
    }

    public function getProjectClientTypeAttribute(): string
    {
        return match($this->category) {
            'residential'      => 'Rumah Tinggal & Perumahan Warga',
            'commercial_resto' => 'Restoran, Kafe & Dapur Komersial F&B',
            'commercial_b2b'   => 'Gedung Perkantoran, Pabrik & Industri',
            'cctv_inspection'  => 'Fasilitas Komersial & Bangunan Publik',
            'before_after'     => 'Residensial & Bangunan Komersial',
            default            => 'Properti Komersial & Residensial',
        };
    }

    public function getRelatedAreaUrlAttribute(): string
    {
        $loc = strtolower($this->location_tag ?? '');
        if (str_contains($loc, 'jaksel') || str_contains($loc, 'selatan')) {
            return route('area.city', 'jakarta-selatan');
        }
        if (str_contains($loc, 'jaktim') || str_contains($loc, 'timur')) {
            return route('area.city', 'jakarta-timur');
        }
        if (str_contains($loc, 'jakbar') || str_contains($loc, 'barat')) {
            return route('area.city', 'jakarta-barat');
        }
        if (str_contains($loc, 'jakpus') || str_contains($loc, 'pusat')) {
            return route('area.city', 'jakarta-pusat');
        }
        if (str_contains($loc, 'jakut') || str_contains($loc, 'utara')) {
            return route('area.city', 'jakarta-utara');
        }
        if (str_contains($loc, 'bandung')) {
            return route('area.city', 'bandung');
        }
        if (str_contains($loc, 'depok')) {
            return route('area.city', 'depok');
        }
        if (str_contains($loc, 'bekasi')) {
            return route('area.city', 'bekasi');
        }
        if (str_contains($loc, 'tangerang')) {
            return route('area.city', 'tangerang-selatan');
        }
        if (str_contains($loc, 'bogor')) {
            return route('area.city', 'bogor');
        }
        if (str_contains($loc, 'yogyakarta') || str_contains($loc, 'jogja')) {
            return route('area.city', 'yogyakarta');
        }
        if (str_contains($loc, 'semarang')) {
            return route('area.city', 'semarang');
        }
        if (str_contains($loc, 'surabaya')) {
            return route('area.city', 'surabaya');
        }
        return route('area-layanan');
    }

    public function getRelatedAreaNameAttribute(): string
    {
        return !empty($this->location_tag) ? $this->location_tag : 'Jabodetabek';
    }

    public function getFaqItemsAttribute(): array
    {
        return [
            [
                'q' => 'Apakah proses pelancaran ini membongkar lantai atau ubin keramik?',
                'a' => 'Sama sekali tidak! Seluruh pengerjaan Rootera Plumbing menggunakan teknologi spiral rotary & hydro jetting tanpa bongkar, sehingga area bangunan Anda tetap utuh, rapi, dan bersih.'
            ],
            [
                'q' => 'Berapa lama estimasi waktu pengerjaan sampai pipa lancar kembali?',
                'a' => 'Rata-rata pengerjaan membutuhkan waktu 30 hingga 60 menit tergantung pada tingkat keparahan sumbatan dan panjang jaringan pipa.'
            ],
            [
                'q' => 'Apakah pengerjaan ini bergaransi?',
                'a' => 'Ya, kami memberikan garansi pengerjaan resmi selama 30 hari. Jika pipa kembali mampet dalam masa garansi, teknisi kami akan datang melakukan perbaikan ulang gratis!'
            ],
            [
                'q' => 'Berapa biaya jasa pelancaran pipa mampet di Rootera Plumbing?',
                'a' => 'Biaya sangat terjangkau dan transparan sesuai jenis masalah & lokasi. Anda dapat berkonsultasi gratis dan memperoleh estimasi biaya tepat sebelum teknisi meluncur.'
            ]
        ];
    }

    public function getPopularTagsAttribute(): array
    {
        $loc = strtolower($this->location_tag ?? '');

        if (str_contains($loc, 'jaksel') || str_contains($loc, 'selatan')) {
            return [
                ['label' => 'Jasa Pipa Mampet Jakarta Selatan', 'url' => route('area.city', 'jakarta-selatan')],
                ['label' => 'Pelancar Pipa Kebayoran Baru', 'url' => route('area.city', 'jakarta-selatan')],
                ['label' => 'Wastafel Mampet Cilandak', 'url' => route('layanan.show', 'wastafel-mampet')],
                ['label' => 'Floor Drain Kemang', 'url' => route('layanan.show', 'kamar-mandi-mampet')],
                ['label' => 'Pipa Dapur Resto Tebet', 'url' => route('b2b.sector', 'restoran-cafe')],
                ['label' => 'Inspeksi CCTV Pondok Indah', 'url' => route('b2b.index')],
                ['label' => 'Kloset Mampet Jagakarsa', 'url' => route('layanan.show', 'wc-toilet-mampet')],
                ['label' => 'Pembersihan Got Pasar Minggu', 'url' => route('layanan.show', 'got-saluran-pembuangan')],
            ];
        }

        if (str_contains($loc, 'jaktim') || str_contains($loc, 'timur')) {
            return [
                ['label' => 'Jasa Pipa Mampet Jakarta Timur', 'url' => route('area.city', 'jakarta-timur')],
                ['label' => 'Pelancar Pipa Cibubur', 'url' => route('area.city', 'jakarta-timur')],
                ['label' => 'Saluran Mampet Pasar Rebo', 'url' => route('area.city', 'jakarta-timur')],
                ['label' => 'Wastafel Dapur Duren Sawit', 'url' => route('layanan.show', 'wastafel-mampet')],
                ['label' => 'Floor Drain Cipayung', 'url' => route('layanan.show', 'kamar-mandi-mampet')],
                ['label' => 'Hydro Jetting Pabrik Cakung', 'url' => route('b2b.sector', 'pabrik-industri')],
                ['label' => 'Inspeksi CCTV Matraman', 'url' => route('b2b.index')],
            ];
        }

        if (str_contains($loc, 'jakbar') || str_contains($loc, 'barat')) {
            return [
                ['label' => 'Jasa Pipa Mampet Jakarta Barat', 'url' => route('area.city', 'jakarta-barat')],
                ['label' => 'Pelancar Pipa Puri Indah', 'url' => route('area.city', 'jakarta-barat')],
                ['label' => 'Wastafel Resto Kebon Jeruk', 'url' => route('b2b.sector', 'restoran-cafe')],
                ['label' => 'Floor Drain Cengkareng', 'url' => route('layanan.show', 'kamar-mandi-mampet')],
                ['label' => 'Pipa Got Kembangan', 'url' => route('layanan.show', 'got-saluran-pembuangan')],
                ['label' => 'Kloset Mampet Grogol', 'url' => route('layanan.show', 'wc-toilet-mampet')],
            ];
        }

        if (str_contains($loc, 'jakpus') || str_contains($loc, 'pusat')) {
            return [
                ['label' => 'Jasa Pipa Mampet Jakarta Pusat', 'url' => route('area.city', 'jakarta-pusat')],
                ['label' => 'Pelancar Saluran Menteng', 'url' => route('area.city', 'jakarta-pusat')],
                ['label' => 'Wastafel Resto Tanah Abang', 'url' => route('b2b.sector', 'restoran-cafe')],
                ['label' => 'Kloset Mampet Cempaka Putih', 'url' => route('layanan.show', 'wc-toilet-mampet')],
                ['label' => 'Inspeksi CCTV Kemayoran', 'url' => route('b2b.index')],
            ];
        }

        if (str_contains($loc, 'jakut') || str_contains($loc, 'utara')) {
            return [
                ['label' => 'Jasa Pipa Mampet Jakarta Utara', 'url' => route('area.city', 'jakarta-utara')],
                ['label' => 'Pelancar Pipa Kelapa Gading', 'url' => route('area.city', 'jakarta-utara')],
                ['label' => 'Saluran Resto PIK', 'url' => route('b2b.sector', 'restoran-cafe')],
                ['label' => 'Floor Drain Pluit', 'url' => route('layanan.show', 'kamar-mandi-mampet')],
                ['label' => 'Inspeksi CCTV Sunter', 'url' => route('b2b.index')],
            ];
        }

        if (str_contains($loc, 'bandung')) {
            return [
                ['label' => 'Jasa Pipa Mampet Bandung', 'url' => route('area.city', 'bandung')],
                ['label' => 'Pelancar Saluran Cimahi', 'url' => route('area.city', 'bandung')],
                ['label' => 'Wastafel Resto Dago', 'url' => route('b2b.sector', 'restoran-cafe')],
                ['label' => 'Floor Drain Buahbatu', 'url' => route('layanan.show', 'kamar-mandi-mampet')],
            ];
        }

        return [
            ['label' => 'Jasa Pipa Mampet Jabodetabek', 'url' => route('area-layanan')],
            ['label' => 'Pelancar Pipa Tanpa Bongkar', 'url' => route('layanan')],
            ['label' => 'Mesin Rooter Spiral Ridgid', 'url' => route('layanan')],
            ['label' => 'Inspeksi Pipa CCTV HD', 'url' => route('b2b.index')],
            ['label' => 'Hydro-Jetting High Pressure', 'url' => route('b2b.index')],
            ['label' => 'Sedot Lemak Grease Trap Resto', 'url' => route('b2b.sector', 'restoran-cafe')],
            ['label' => 'Floor Drain Kamar Mandi Mampet', 'url' => route('layanan.show', 'kamar-mandi-mampet')],
            ['label' => 'Pelancaran Kloset Toilet Mampet', 'url' => route('layanan.show', 'wc-toilet-mampet')],
        ];
    }
}
