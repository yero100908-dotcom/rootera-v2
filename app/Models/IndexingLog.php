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
        'engine',
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
     * Scope to filter by indexing engine ('google' or 'indexnow').
     */
    public function scopeForEngine($query, string $engine)
    {
        return $query->where('engine', $engine);
    }

    /**
     * Scope to filter Google Indexing logs.
     */
    public function scopeGoogle($query)
    {
        return $query->where('engine', 'google');
    }

    /**
     * Scope to filter IndexNow logs.
     */
    public function scopeIndexNow($query)
    {
        return $query->where('engine', 'indexnow');
    }

    /**
     * Scope to filter URLs pushed successfully within specified days.
     */
    public function scopePushedRecently($query, int $days = 14, ?string $engine = null)
    {
        $q = $query->where('status', 'success')
            ->where('pushed_at', '>=', Carbon::now()->subDays($days));

        if ($engine !== null) {
            $q->where('engine', $engine);
        }

        return $q;
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
        ?string $responseMessage = null,
        string $engine = 'google'
    ): self {
        return static::updateOrCreate(
            ['url' => $url, 'engine' => $engine],
            [
                'url_type'         => $urlType,
                'action'           => $action,
                'status'           => $status,
                'http_status'      => $httpStatus,
                'response_message' => $responseMessage,
                'pushed_at'        => in_array($status, ['success', 'failed'], true) ? now() : null,
            ]
        );
    }

    /**
     * Check if a URL was recently pushed and should be skipped.
     */
    public static function isRecentlyPushed(string $url, int $days = 14, string $engine = 'google'): bool
    {
        return static::where('url', $url)
            ->where('engine', $engine)
            ->where('status', 'success')
            ->where('pushed_at', '>=', Carbon::now()->subDays($days))
            ->exists();
    }
}
