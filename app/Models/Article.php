<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    public const LIST_COLUMNS = [
        'id', 'title', 'slug', 'excerpt', 'thumbnail', 'thumbnail_alt',
        'author', 'category', 'status', 'published_at',
        'views', 'youtube_video_id', 'post_type', 'promo_end_date',
        'location_geo', 'client_name', 'is_headline',
        'is_featured', 'read_time', 'tags',
    ];

    public const TYPE_ARTICLE = 'article';
    public const TYPE_PROMO = 'promo';
    public const TYPE_NEWS = 'news';
    public const TYPE_CASE_STUDY = 'case_study';
    public const TYPE_PRESS_RELEASE = 'press_release';
    public const TYPE_VIDEO_GUIDE = 'video_guide';

    public const POST_TYPES = [
        self::TYPE_ARTICLE => 'Edukasi Teknis (Artikel)',
        self::TYPE_PROMO => 'Promo Khusus',
        self::TYPE_NEWS => 'Kabar Perusahaan',
        self::TYPE_CASE_STUDY => 'Studi Kasus & Portofolio B2B',
        self::TYPE_PRESS_RELEASE => 'Press Release / Rilis Media',
        self::TYPE_VIDEO_GUIDE => 'Video Panduan (Rootera TV)',
    ];

    public const CATEGORIES = [
        'Regulasi & Kepatuhan B2B' => 'Regulasi & Kepatuhan B2B (Grease Trap & AMDAL)',
        'Investigasi Teknik & Diagnosa' => 'Investigasi Teknik & Diagnosa CCTV',
        'Analisis Biaya & Metode' => 'Analisis Biaya & Metode (Hydro Jetting vs Rotary)',
        'Tips Rumah' => 'Panduan Sanitasi Residensial',
        'Komersial & B2B' => 'Komersial & Industri B2B',
        'Material & Instalasi' => 'Material & Instalasi Pipa',
    ];

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'thumbnail', 'thumbnail_alt',
        'author', 'status', 'published_at', 'meta_title',
        'meta_description', 'tags', 'og_image', 'canonical_url', 'views',
        'youtube_video_id', 'video_embed_url', 'post_type',
        'promo_end_date', 'location_geo', 'client_name',
        'category', 'is_headline', 'is_featured', 'read_time',
    ];

    protected $casts = [
        'published_at'   => 'datetime',
        'promo_end_date' => 'datetime',
        'is_headline'    => 'boolean',
        'is_featured'    => 'boolean',
        'read_time'      => 'integer',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeHeadline($query)
    {
        return $query->where('is_headline', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePromo($query)
    {
        return $query->where('post_type', self::TYPE_PROMO);
    }

    public function scopeCaseStudy($query)
    {
        return $query->where('post_type', self::TYPE_CASE_STUDY);
    }

    public function scopeNews($query)
    {
        return $query->where('post_type', self::TYPE_NEWS);
    }

    public function scopeArticle($query)
    {
        return $query->where('post_type', self::TYPE_ARTICLE);
    }

    public function scopePressRelease($query)
    {
        return $query->where('post_type', self::TYPE_PRESS_RELEASE);
    }

    public function scopeActivePromo($query)
    {
        return $query->promo()
                     ->where(function ($q) {
                         $q->whereNull('promo_end_date')
                           ->orWhere('promo_end_date', '>=', now());
                     });
    }

    public function isPromo(): bool
    {
        return $this->post_type === self::TYPE_PROMO;
    }

    public function isCaseStudy(): bool
    {
        return $this->post_type === self::TYPE_CASE_STUDY;
    }

    public function isPromoActive(): bool
    {
        if (!$this->isPromo()) {
            return false;
        }

        return $this->promo_end_date === null || $this->promo_end_date->isFuture();
    }

    public function getPostTypeLabelAttribute(): string
    {
        return self::POST_TYPES[$this->post_type] ?? ucfirst($this->post_type ?? 'Artikel');
    }

    public function getReadingTimeAttribute(): int
    {
        if ($this->read_time && $this->read_time > 0) {
            return (int) $this->read_time;
        }

        $cleanText = strip_tags($this->content ?? '');
        $wordCount = str_word_count($cleanText);
        $minutes = (int) ceil($wordCount / 200);

        return max($minutes, 1);
    }

    public function getThumbnailUrlAttribute(): string
    {
        if (!empty($this->thumbnail)) {
            $thumb = trim($this->thumbnail);

            if (\Illuminate\Support\Str::startsWith($thumb, ['http://', 'https://'])) {
                if (!str_contains($thumb, 'rooteraplumbing')) {
                    return $thumb;
                }
                $parsed = parse_url($thumb, PHP_URL_PATH);
                if ($parsed) {
                    $thumb = ltrim($parsed, '/');
                }
            }

            $cleanPath = ltrim($thumb, '/');

            if (\Illuminate\Support\Str::startsWith($cleanPath, 'storage/') || \Illuminate\Support\Str::startsWith($cleanPath, 'images/')) {
                return asset($cleanPath);
            }

            if (\Illuminate\Support\Str::startsWith($cleanPath, 'articles/')) {
                return asset('storage/' . $cleanPath);
            }

            return asset('storage/' . $cleanPath);
        }

        if ($this->safe_youtube_id) {
            return "https://i.ytimg.com/vi/{$this->safe_youtube_id}/hqdefault.jpg";
        }

        return asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp');
    }

    public function getSafeYoutubeIdAttribute(): ?string
    {
        if (empty($this->youtube_video_id)) {
            return null;
        }

        $id = trim($this->youtube_video_id);
        return preg_match('/^[a-zA-Z0-9_-]{11}$/', $id) ? $id : null;
    }

    public function getCleanTitleAttribute(): string
    {
        $title = preg_replace('/#\S+/', '', $this->title ?? '');
        return trim(preg_replace('/\s+/', ' ', $title));
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}

