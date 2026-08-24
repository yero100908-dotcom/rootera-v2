<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id',
        'name',
        'type',
        'slug',
        'phone_number',
        'whatsapp_number',
        'estimated_arrival',
        'meta_title',
        'meta_description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class)->orderBy('sort_order')->orderBy('name');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->type} {$this->name}";
    }
}
