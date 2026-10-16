<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'name',
        'slug',
        'postal_code',
        'latitude',
        'longitude',
        'landmarks',
        'typical_issues',
        'soil_water_profile',
        'intro_override',
        'estimated_arrival',
        'meta_title',
        'meta_description',
        'is_indexable',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'is_indexable'   => 'boolean',
        'landmarks'      => 'array',
        'typical_issues' => 'array',
        'latitude'       => 'float',
        'longitude'      => 'float',
        'content_score'  => 'integer',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function residentialClusters(): BelongsToMany
    {
        return $this->belongsToMany(ResidentialCluster::class, 'cluster_district', 'district_id', 'residential_cluster_id');
    }

    public function projectGalleries(): HasMany
    {
        return $this->hasMany(ProjectGallery::class);
    }
}
