<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'tool_name',
        'slug',
        'type_brand',
        'main_spec',
        'pipe_target',
        'main_advantage',
        'badge_text',
        'badge_color',
        'image_path',
        'description',
        'feature_1_label',
        'feature_1_value',
        'feature_2_label',
        'feature_2_value',
        'sort_order',
        'order_priority',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'order_priority' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($tech) {
            if (empty($tech->slug) && !empty($tech->tool_name)) {
                $tech->slug = Str::slug($tech->tool_name);
            }
        });
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image_path) {
            return asset('images/JnJ.webp');
        }

        if (Str::startsWith($this->image_path, ['http://', 'https://', 'images/', 'assets/'])) {
            return asset($this->image_path);
        }

        return asset('storage/' . $this->image_path);
    }

    // Alias name for tool_name
    public function getNameAttribute()
    {
        return $this->tool_name;
    }
}
