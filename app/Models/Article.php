<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'thumbnail',
        'author', 'status', 'published_at', 'meta_title',
        'meta_description', 'og_image', 'canonical_url', 'views',
        'youtube_video_id', 'video_embed_url', 'post_type', 'category',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function getThumbnailUrlAttribute(): string
    {
        // Jika artikel berbentuk video (memiliki youtube_video_id atau post_type 'video_guide')
        if ($this->youtube_video_id || $this->post_type === 'video_guide') {
            if ($this->thumbnail && \Illuminate\Support\Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
                return $this->thumbnail;
            }
            if ($this->youtube_video_id) {
                return "https://i.ytimg.com/vi/{$this->youtube_video_id}/hqdefault.jpg";
            }
        }

        // Untuk artikel catatan (bukan video), sambungkan seluruh thumbnail ke public/images/JnJ.webp
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
