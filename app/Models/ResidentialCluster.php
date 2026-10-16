<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Residential cluster / perumahan (PIK, BSD City, Bintaro Jaya, …).
 *
 * A cluster has one "primary" city & district for breadcrumb/schema purposes,
 * but may span several kecamatan through the `cluster_district` pivot.
 */
class ResidentialCluster extends Model
{
    use HasFactory;

    public const INDEX_THRESHOLD = 70;

    public const TIERS = ['elite', 'premium', 'mid'];

    protected $fillable = [
        'city_id',
        'district_id',
        'name',
        'slug',
        'short_name',
        'tier',
        'developer',
        'built_year',
        'latitude',
        'longitude',
        'landmarks',
        'typical_issues',
        'sub_clusters',
        'property_profile',
        'estimated_arrival',
        'intro_override',
        'meta_title',
        'meta_description',
        'is_indexable',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'landmarks'      => 'array',
            'typical_issues' => 'array',
            'sub_clusters'   => 'array',
            'latitude'       => 'float',
            'longitude'      => 'float',
            'built_year'     => 'integer',
            'content_score'  => 'integer',
            'is_indexable'   => 'boolean',
            'is_active'      => 'boolean',
            'sort_order'     => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /* ── Relationships ─────────────────────────────────────────────── */

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function districts(): BelongsToMany
    {
        return $this->belongsToMany(District::class, 'cluster_district', 'residential_cluster_id', 'district_id');
    }

    public function projectGalleries(): HasMany
    {
        return $this->hasMany(ProjectGallery::class, 'residential_cluster_id');
    }

    /* ── Scopes ────────────────────────────────────────────────────── */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeIndexable(Builder $query): Builder
    {
        return $query->where('is_active', true)->where('is_indexable', true);
    }

    /* ── Accessors ─────────────────────────────────────────────────── */

    public function getDisplayNameAttribute(): string
    {
        return $this->short_name ?: $this->name;
    }

    public function getHasCoordinatesAttribute(): bool
    {
        return $this->latitude !== null && $this->longitude !== null;
    }

    public function getRobotsAttribute(): string
    {
        return ($this->is_active && $this->is_indexable) ? 'index, follow' : 'noindex, follow';
    }
}
