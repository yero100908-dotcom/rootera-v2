<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    public const CATEGORIES = [
        'Regulasi & Kepatuhan B2B' => 'Regulasi & Kepatuhan B2B (Grease Trap & AMDAL)',
        'Investigasi Teknik & Diagnosa' => 'Investigasi Teknik & Diagnosa CCTV',
        'Analisis Biaya & Metode' => 'Analisis Biaya & Metode (Hydro Jetting vs Rotary)',
        'Tips Rumah' => 'Panduan Sanitasi Residensial',
        'Komersial & B2B' => 'Komersial & Industri B2B',
        'Material & Instalasi' => 'Material & Instalasi Pipa',
    ];

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'thumbnail',
        'author', 'status', 'published_at', 'meta_title',
        'meta_description', 'og_image', 'canonical_url', 'views',
        'youtube_video_id', 'video_embed_url', 'post_type', 'category',
        'is_headline', 'is_featured', 'read_time',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_headline'  => 'boolean',
        'is_featured'  => 'boolean',
        'read_time'    => 'integer',
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
        if ($this->thumbnail) {
            if (\Illuminate\Support\Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
                if (!str_contains($this->thumbnail, 'rooteraplumbing')) {
                    return $this->thumbnail;
                }
                $parsed = parse_url($this->thumbnail, PHP_URL_PATH);
                if ($parsed) {
                    $this->thumbnail = ltrim($parsed, '/');
                }
            }

            $cleanPath = ltrim($this->thumbnail, '/');

            if (file_exists(public_path($cleanPath))) {
                return asset($cleanPath);
            }

            if (!\Illuminate\Support\Str::startsWith($cleanPath, 'storage/')) {
                $storagePath = 'storage/' . $cleanPath;
                if (file_exists(public_path($storagePath))) {
                    return asset($storagePath);
                }
            }

            if (!\Illuminate\Support\Str::startsWith($cleanPath, 'images/')) {
                $imagesPath = 'images/' . $cleanPath;
                if (file_exists(public_path($imagesPath))) {
                    return asset($imagesPath);
                }
            }

            $appPublicPath = storage_path('app/public/' . ltrim(preg_replace('#^storage/#', '', $cleanPath), '/'));
            if (file_exists($appPublicPath)) {
                return asset('storage/' . ltrim(preg_replace('#^storage/#', '', $cleanPath), '/'));
            }
        }

        if ($this->youtube_video_id) {
            return "https://i.ytimg.com/vi/{$this->youtube_video_id}/hqdefault.jpg";
        }

        return asset('images/JnJ.webp');
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

