<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Keyword synonym / alias for a ServiceCategory
 * (e.g. "paralon mampet", "servis pipa buntu", "tembak saluran").
 *
 * usage = copy_only    → only injected as natural copy variation, no own URL.
 * usage = landing_page → eligible for a dedicated landing page (distinct intent).
 */
class ServiceAlias extends Model
{
    use HasFactory;

    public const INTENTS = ['transactional', 'problem', 'informational'];
    public const USAGES  = ['copy_only', 'landing_page'];

    protected $fillable = [
        'service_category_id',
        'keyword',
        'slug',
        'intent',
        'usage',
        'search_volume',
        'intro_override',
        'faq_overrides',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'faq_overrides' => 'array',
            'search_volume' => 'integer',
            'is_active'     => 'boolean',
        ];
    }

    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeCopyOnly(Builder $query): Builder
    {
        return $query->where('usage', 'copy_only');
    }

    public function scopeLandingPage(Builder $query): Builder
    {
        return $query->where('usage', 'landing_page');
    }
}

