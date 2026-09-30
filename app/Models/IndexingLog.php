<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class IndexingLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'url_type',
        'action',
        'status',
        'http_status',
        'response_message',
        'pushed_at',
    ];

    protected $casts = [
        'pushed_at' => 'datetime',
        'http_status' => 'integer',
    ];

    /**
     * Scope to filter URLs pushed successfully within specified days.
     */
    public function scopePushedRecently($query, int $days = 14)
    {
        return $query->where('status', 'success')
            ->where('pushed_at', '>=', Carbon::now()->subDays($days));
    }

    /**
     * Scope to filter failed push logs.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope to filter logs by exact URL.
     */
    public function scopeByUrl($query, string $url)
    {
        return $query->where('url', $url);
    }

    /**
     * Record an indexing log attempt.
     */
    public static function recordAttempt(
        string $url,
        string $urlType,
        string $action = 'URL_UPDATED',
        string $status = 'pending',
        ?int $httpStatus = null,
        ?string $responseMessage = null
    ): self {
        return static::updateOrCreate(
            ['url' => $url],
            [
                'url_type'         => $urlType,
                'action'           => $action,
                'status'           => $status,
                'http_status'      => $httpStatus,
                'response_message' => $responseMessage,
                'pushed_at'        => $status === 'success' ? now() : ($status === 'failed' ? now() : null),
            ]
        );
    }

    /**
     * Check if a URL was recently pushed and should be skipped.
     */
    public static function isRecentlyPushed(string $url, int $days = 14): bool
    {
        return static::where('url', $url)
            ->where('status', 'success')
            ->where('pushed_at', '>=', Carbon::now()->subDays($days))
            ->exists();
    }
}
