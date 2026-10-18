<?php

declare(strict_types=1);

namespace App\Services\Seo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Class IndexNowService
 *
 * Handles URL indexing submissions to search engines (Bing, Yandex, Seznam, Naver)
 * using the IndexNow open protocol.
 */
class IndexNowService
{
    protected string $key;
    protected string $host;
    protected string $keyLocation;
    protected string $endpoint;

    public function __construct(
        ?string $key = null,
        ?string $host = null,
        ?string $keyLocation = null,
        ?string $endpoint = null
    ) {
        $this->key = $key ?: (string) config('services.indexnow.key', '680322f5a13b421c8c27fe4e6e677e7a');
        $this->host = $host ?: (string) config('services.indexnow.host', 'rooteraplumbing.id');
        
        $defaultKeyLocation = "https://{$this->host}/{$this->key}.txt";
        $this->keyLocation = $keyLocation ?: (string) config('services.indexnow.key_location', $defaultKeyLocation);
        $this->endpoint = $endpoint ?: (string) config('services.indexnow.endpoint', 'https://api.indexnow.org/indexnow');
    }

    /**
     * Submit a single URL to IndexNow via HTTP POST (or GET).
     *
     * @param string $url
     * @param string $method
     * @return array{success: bool, status_code: int, message: string, url: string, raw_response: ?string}
     */
    public function submitUrl(string $url, string $method = 'POST'): array
    {
        $url = trim($url);

        try {
            if (strtoupper($method) === 'GET') {
                $response = Http::timeout(15)
                    ->get($this->endpoint, [
                        'url'         => $url,
                        'key'         => $this->key,
                        'keyLocation' => $this->keyLocation,
                    ]);
            } else {
                // Standard POST method
                $response = Http::timeout(15)
                    ->withHeaders([
                        'Content-Type' => 'application/json; charset=utf-8',
                    ])
                    ->post($this->endpoint, [
                        'host'        => $this->host,
                        'key'         => $this->key,
                        'keyLocation' => $this->keyLocation,
                        'url'         => $url,
                    ]);
            }

            $statusCode = $response->status();
            $isSuccess = in_array($statusCode, [200, 202], true);
            $message = $this->interpretStatusCode($statusCode);

            if ($isSuccess) {
                Log::info("IndexNow: Successfully submitted URL: {$url} (HTTP {$statusCode})");
            } else {
                Log::warning("IndexNow: Submission returned HTTP {$statusCode} for URL: {$url}. Details: {$message}");
            }

            return [
                'success'      => $isSuccess,
                'status_code'  => $statusCode,
                'message'      => $message,
                'url'          => $url,
                'raw_response' => $response->body() ?: null,
            ];
        } catch (Throwable $e) {
            Log::error("IndexNow: Exception while submitting URL [{$url}]: " . $e->getMessage());

            return [
                'success'      => false,
                'status_code'  => 500,
                'message'      => 'Network/Client error: ' . $e->getMessage(),
                'url'          => $url,
                'raw_response' => null,
            ];
        }
    }

    /**
     * Submit a batch list of URLs (up to 10,000 URLs per request) to IndexNow via POST.
     *
     * @param array<int, string> $urls
     * @return array{success: bool, status_code: int, message: string, submitted_count: int, raw_response: ?string}
     */
    public function submitBatch(array $urls): array
    {
        $cleanUrls = array_values(array_filter(array_unique(array_map('trim', $urls))));
        $total = count($cleanUrls);

        if ($total === 0) {
            return [
                'success'         => false,
                'status_code'     => 400,
                'message'         => 'No valid URLs provided for submission.',
                'submitted_count' => 0,
                'raw_response'    => null,
            ];
        }

        // If only 1 URL, can submit via single URL POST
        if ($total === 1) {
            $single = $this->submitUrl($cleanUrls[0]);
            return [
                'success'         => $single['success'],
                'status_code'     => $single['status_code'],
                'message'         => $single['message'],
                'submitted_count' => $single['success'] ? 1 : 0,
                'raw_response'    => $single['raw_response'],
            ];
        }

        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/json; charset=utf-8',
                ])
                ->post($this->endpoint, [
                    'host'        => $this->host,
                    'key'         => $this->key,
                    'keyLocation' => $this->keyLocation,
                    'urlList'     => $cleanUrls,
                ]);

            $statusCode = $response->status();
            $isSuccess = in_array($statusCode, [200, 202], true);
            $message = $this->interpretStatusCode($statusCode);

            if ($isSuccess) {
                Log::info("IndexNow: Successfully submitted batch of {$total} URLs (HTTP {$statusCode})");
            } else {
                Log::warning("IndexNow: Batch submission returned HTTP {$statusCode} for {$total} URLs. Details: {$message}");
            }

            return [
                'success'         => $isSuccess,
                'status_code'     => $statusCode,
                'message'         => $message,
                'submitted_count' => $isSuccess ? $total : 0,
                'raw_response'    => $response->body() ?: null,
            ];
        } catch (Throwable $e) {
            Log::error("IndexNow: Exception while submitting batch of {$total} URLs: " . $e->getMessage());

            return [
                'success'         => false,
                'status_code'     => 500,
                'message'         => 'Network/Client error: ' . $e->getMessage(),
                'submitted_count' => 0,
                'raw_response'    => null,
            ];
        }
    }

    /**
     * Submit single URL safely without throwing exceptions (safe for Observers and event hooks).
     *
     * @param string $url
     * @return bool
     */
    public function submitUrlSafely(string $url): bool
    {
        try {
            $result = $this->submitUrl($url);
            return $result['success'];
        } catch (Throwable $e) {
            Log::warning("IndexNow submitUrlSafely suppressed error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Interpret IndexNow standard HTTP status codes.
     */
    protected function interpretStatusCode(int $statusCode): string
    {
        return match ($statusCode) {
            200 => 'OK — URL/Batch submitted successfully.',
            202 => 'Accepted — URL/Batch received, IndexNow key validation pending.',
            400 => 'Bad Request — Invalid request format or parameters.',
            403 => 'Forbidden — Key not valid, key file missing, or keyLocation mismatch.',
            422 => 'Unprocessable Entity — URLs do not belong to the host or key schema invalid.',
            429 => 'Too Many Requests — Rate limit reached. Try again later.',
            default => "Response HTTP {$statusCode}",
        };
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getKeyLocation(): string
    {
        return $this->keyLocation;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }
}
