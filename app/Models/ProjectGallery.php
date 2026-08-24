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
        return $this->after_image ? asset('storage/' . $this->after_image) : asset('images/ridgid.jpeg');
    }

    public function getBeforeImageUrlAttribute(): string
    {
        return $this->before_image ? asset('storage/' . $this->before_image) : asset('images/JnJ.jpeg');
    }
}
