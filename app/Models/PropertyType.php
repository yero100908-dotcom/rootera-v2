<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'hero_headline',
        'meta_title',
        'meta_description',
        'common_issues',
        'fast_solutions',
        'price_starting_from',
        'estimated_time',
        'guarantee_days',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'common_issues' => 'array',
        'fast_solutions' => 'array',
        'guarantee_days' => 'integer',
        'sort_order' => 'integer',
    ];
}
