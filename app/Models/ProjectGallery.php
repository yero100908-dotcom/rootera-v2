<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_category_id',
        'city_id',
        'district_id',
        'title',
        'slug',
        'client_type',
        'before_image',
        'after_image',
        'description',
        'completion_time',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Dynamic Image Alt tag generator for Image SEO
     */
    public function getImageAltAttribute(): string
    {
        $loc = '';
        if ($this->district) {
            $loc .= $this->district->name . ', ';
        }
        if ($this->city) {
            $loc .= $this->city->name;
        }
        $loc = trim($loc, ', ');

        return "Pengerjaan {$this->title}" . ($loc ? " di {$loc}" : "") . " - Rootera Plumbing";
    }

    public function getAfterImageUrlAttribute(): string
    {
        if ($this->after_image) {
            if (\Illuminate\Support\Str::startsWith($this->after_image, ['http://', 'https://'])) {
                return $this->after_image;
            }
            $path = \Illuminate\Support\Str::startsWith($this->after_image, ['storage/', 'images/', 'assets/'])
                ? $this->after_image
                : 'storage/' . $this->after_image;

            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }
        return asset('images/ridgid.jpeg');
    }

    public function getBeforeImageUrlAttribute(): string
    {
        if ($this->before_image) {
            if (\Illuminate\Support\Str::startsWith($this->before_image, ['http://', 'https://'])) {
                return $this->before_image;
            }
            $path = \Illuminate\Support\Str::startsWith($this->before_image, ['storage/', 'images/', 'assets/'])
                ? $this->before_image
                : 'storage/' . $this->before_image;

            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }
        return asset('images/JnJ.jpeg');
    }
}
