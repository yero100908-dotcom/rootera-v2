<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceSector extends Model
{
    use HasFactory;

    protected $fillable = [
        'sector_name',
        'slug',
        'icon',
        'hero_headline',
        'short_description',
        'pain_points',
        'solutions_offered',
        'sla_guarantee',
        'recommended_methods',
        'service_contract_options',
        'image_path',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'pain_points' => 'array',
        'solutions_offered' => 'array',
        'recommended_methods' => 'array',
        'service_contract_options' => 'array',
    ];

    public function getImageUrlAttribute(): string
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : asset('images/JnJ.jpeg');
    }
}
