<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_category_id',
        'name',
        'title',
        'slug',
        'short_description',
        'full_description',
        'content',
        'image',
        'image_path',
        'icon',
        'price_start',
        'price_residential',
        'price_commercial',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'price_start' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function getImageUrlAttribute(): string
    {
        $path = $this->image_path ?? $this->image;
        return $path ? asset('storage/' . $path) : asset('images/placeholder.jpg');
    }

    public function getPriceResidentialFormattedAttribute(): string
    {
        return $this->price_residential ?? 'Hubungi Kami';
    }

    public function getPriceCommercialFormattedAttribute(): string
    {
        return $this->price_commercial ?? 'Hubungi Kami';
    }
}
