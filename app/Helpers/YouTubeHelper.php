<?php

namespace App\Helpers;

class YouTubeHelper
{
    /**
     * Extract 11-character YouTube Video ID from various URL formats or direct ID string.
     *
     * Supported Formats:
     * - Standard: https://www.youtube.com/watch?v=VIDEO_ID
     * - Shortlink: https://youtu.be/VIDEO_ID
     * - Embed: https://www.youtube.com/embed/VIDEO_ID
     * - No-cookie Embed: https://www.youtube-nocookie.com/embed/VIDEO_ID
     * - Shorts: https://www.youtube.com/shorts/VIDEO_ID
     * - Direct ID: VIDEO_ID (11 alphanumeric, underscore, hyphen chars)
     *
     * @param string|null $input
     * @return string|null
     */
    public static function extractId(?string $input): ?string
    {
        if (empty($input)) {
            return null;
        }

        $input = trim($input);

        // Direct 11-character Video ID
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $input)) {
            return $input;
        }

        // Comprehensive YouTube URL pattern
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/|youtube-nocookie\.com\/embed\/)([a-zA-Z0-9_-]{11})/i';

        if (preg_match($pattern, $input, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Check if the YouTube link is a Shorts video (9:16 vertical aspect ratio).
     *
     * @param string|null $input
     * @return bool
     */
    public static function isShorts(?string $input): bool
    {
        if (empty($input)) {
            return false;
        }

        return (bool) preg_match('/(?:youtube\.com\/shorts\/)/i', trim($input));
    }

    /**
     * Get official YouTube Channel URL.
     *
     * @return string
     */
    public static function getChannelUrl(): string
    {
        $channelId = config('services.youtube.channel_id', env('YOUTUBE_CHANNEL_ID', 'UCKC8vr5ES6beRrSkgOq_4qw'));
        return "https://www.youtube.com/channel/{$channelId}";
    }

    /**
     * Get privacy-enhanced YouTube embed URL (youtube-nocookie.com).
     *
     * @param string|null $input
     * @param array $params Optional query params e.g. ['autoplay' => 1, 'rel' => 0]
     * @return string|null
     */
    public static function getEmbedUrl(?string $input, array $params = []): ?string
    {
        $id = static::extractId($input);
        if (!$id) {
            return null;
        }

        $baseUrl = "https://www.youtube-nocookie.com/embed/{$id}";

        if (!empty($params)) {
            $query = http_build_query($params);
            return "{$baseUrl}?{$query}";
        }

        return $baseUrl;
    }

    /**
     * Get YouTube WebP or JPG thumbnail URL.
     *
     * @param string|null $input
     * @param string $quality 'maxresdefault' | 'hqdefault' | 'mqdefault' | 'sddefault'
     * @param bool $webp
     * @return string|null
     */
    public static function getThumbnailUrl(?string $input, string $quality = 'hqdefault', bool $webp = true): ?string
    {
        $id = static::extractId($input);
        if (!$id) {
            return null;
        }

        if ($webp) {
            return "https://i.ytimg.com/vi_webp/{$id}/{$quality}.webp";
        }

        return "https://i.ytimg.com/vi/{$id}/{$quality}.jpg";
    }

    /**
     * Get high-resolution YouTube thumbnail URL with fallback to HQ.
     *
     * @param string|null $input
     * @return string|null
     */
    public static function getMaxResThumbnailUrl(?string $input): ?string
    {
        return static::getThumbnailUrl($input, 'maxresdefault', false);
    }
}
