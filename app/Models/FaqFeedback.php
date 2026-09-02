<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FaqFeedback extends Model
{
    use HasFactory;

    protected $table = 'faq_feedback';

    protected $fillable = [
        'faq_id',
        'is_helpful',
        'reason',
        'comment',
        'ip_address',
        'user_agent',
        'is_reviewed',
    ];

    protected $casts = [
        'is_helpful'  => 'boolean',
        'is_reviewed' => 'boolean',
    ];

    public function faq(): BelongsTo
    {
        return $this->belongsTo(Faq::class, 'faq_id');
    }
}
