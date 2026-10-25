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
        'residential_cluster_id',
        'title',
        'slug',
        'client_type',
        'tool_used',
        'pipe_specs',
        'pipe_length',
        'before_image',
        'after_image',
        'description',
        'technical_diagnosis',
        'completion_time',
        'warranty_days',
        'cost_estimate',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active'     => 'boolean',
        'warranty_days' => 'integer',
        'cost_estimate' => 'decimal:2',
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

    public function residentialCluster()
    {
        return $this->belongsTo(ResidentialCluster::class);
    }

    /**
     * Get local project showcases with hierarchical fallback from unified Gallery & ProjectGallery data:
     * 1. Primary: Match from Gallery model (90+ real admin entries)
     * 2. Secondary: Fallback to ProjectGallery records if needed
     * Eager-loads relations efficiently with column selection.
     */
    public static function getLocalShowcases(?int $cityId = null, ?int $districtId = null, int $limit = 3)
    {
        // 1. Fetch from Gallery model (90 real entries)
        $galleries = \App\Models\Gallery::getLocalShowcases($cityId, $districtId, $limit);

        if ($galleries->count() >= $limit) {
            return $galleries;
        }

        // 2. If under limit, top up with ProjectGallery entries
        $results = $galleries;
        $existingTitles = $results->pluck('title')->toArray();

        $pgQuery = static::where('is_active', true)
            ->whereNotIn('title', $existingTitles);

        if ($districtId) {
            $pgQuery->where('district_id', $districtId);
        } elseif ($cityId) {
            $pgQuery->where('city_id', $cityId);
        }

        $pgMatch = $pgQuery->with(['district:id,name,slug', 'city:id,name,slug', 'serviceCategory:id,name,slug'])
            ->latest()
            ->take($limit - $results->count())
            ->get();

        foreach ($pgMatch as $pg) {
            $pg->is_fallback = false;
            $results->push($pg);
        }

        if ($results->count() < $limit) {
            $pgFallback = static::where('is_active', true)
                ->whereNotIn('title', $results->pluck('title')->toArray())
                ->with(['district:id,name,slug', 'city:id,name,slug', 'serviceCategory:id,name,slug'])
                ->latest()
                ->take($limit - $results->count())
                ->get();

            foreach ($pgFallback as $pg) {
                $pg->is_fallback = true;
                $results->push($pg);
            }
        }

        return $results;
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

    protected function resolveAssetUrl(?string $rawPath, string $fallback = 'images/JnJ.jpeg'): string
    {
        if (empty($rawPath)) {
            return asset($fallback);
        }

        if (\Illuminate\Support\Str::startsWith($rawPath, ['http://', 'https://'])) {
            if (!str_contains($rawPath, 'rooteraplumbing')) {
                return $rawPath;
            }
            $parsed = parse_url($rawPath, PHP_URL_PATH);
            if ($parsed) {
                $rawPath = ltrim($parsed, '/');
            }
        }

        $cleanPath = ltrim($rawPath, '/');

        // Eliminasi Disk I/O: Pemetaan deterministik tanpa file_exists() sinkron
        if (\Illuminate\Support\Str::startsWith($cleanPath, ['images/', 'assets/', 'storage/', 'build/'])) {
            return asset($cleanPath);
        }

        if (str_contains($cleanPath, '/')) {
            return asset('storage/' . $cleanPath);
        }

        return asset('images/dokumentasi/' . $cleanPath);
    }

    public function getAfterImageUrlAttribute(): string
    {
        return $this->resolveAssetUrl($this->after_image, 'images/ridgid.jpeg');
    }

    public function getBeforeImageUrlAttribute(): string
    {
        return $this->resolveAssetUrl($this->before_image, 'images/JnJ.jpeg');
    }

    public function getDisplayThumbnailAttribute(): string
    {
        if ($this->after_image) {
            return $this->after_image_url;
        }
        if ($this->before_image) {
            return $this->before_image_url;
        }
        return asset('images/ridgid.jpeg');
    }

    public function getCategoryLabelAttribute(): string
    {
        if ($this->relationLoaded('serviceCategory') && $this->serviceCategory) {
            return $this->serviceCategory->name;
        }
        return 'Studi Kasus';
    }

    public function getRelatedAreaNameAttribute(): string
    {
        if ($this->relationLoaded('district') && $this->district) {
            return $this->district->name;
        }
        if ($this->relationLoaded('city') && $this->city) {
            return $this->city->name;
        }
        return 'Jabodetabek';
    }
}
