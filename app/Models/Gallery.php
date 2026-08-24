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
        'is_featured',
        'is_active',
        'sort_order',
        'published_at',
    ];

    protected $casts = [
        'is_featured'  => 'boolean',
        'is_active'    => 'boolean',
        'published_at' => 'datetime',
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

    public function getDisplayThumbnailAttribute(): string
    {
        if (!$this->thumbnail_path) {
            return asset('images/JnJ.jpeg');
        }
        if (Str::startsWith($this->thumbnail_path, ['http://', 'https://'])) {
            return $this->thumbnail_path;
        }
        if (Str::startsWith($this->thumbnail_path, 'images/')) {
            return asset($this->thumbnail_path);
        }
        return asset('storage/' . $this->thumbnail_path);
    }

    public function getDisplayMediaAttribute(): string
    {
        if ($this->external_media_url) {
            return $this->external_media_url;
        }
        if ($this->media_file_path) {
            if (Str::startsWith($this->media_file_path, ['http://', 'https://'])) {
                return $this->media_file_path;
            }
            if (Str::startsWith($this->media_file_path, ['images/', 'videos/'])) {
                return asset($this->media_file_path);
            }
            return asset('storage/' . $this->media_file_path);
        }
        return $this->display_thumbnail;
    }

    public function getDisplayBeforeImageAttribute(): ?string
    {
        if (!$this->before_image_path) {
            return null;
        }
        if (Str::startsWith($this->before_image_path, ['http://', 'https://'])) {
            return $this->before_image_path;
        }
        if (Str::startsWith($this->before_image_path, 'images/')) {
            return asset($this->before_image_path);
        }
        return asset('storage/' . $this->before_image_path);
    }
}
