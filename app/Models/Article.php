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
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : asset('images/blog-placeholder.jpg');
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
