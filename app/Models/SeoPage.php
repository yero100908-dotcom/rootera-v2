<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeoPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_name',
        'route_name',
        'meta_title',
        'meta_description',
        'og_image',
        'canonical_url',
        'is_indexable',
    ];

    protected $casts = [
        'is_indexable' => 'boolean',
    ];
}
