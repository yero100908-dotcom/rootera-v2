<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogSearchEngineBots
{
    /**
     * Handle an incoming request to log search engine bot visits.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $userAgent = $request->header('User-Agent', '');

        if ($this->isSearchEngineBot($userAgent)) {
            $logData = sprintf(
                "[%s] BOT: %s | URL: %s | STATUS: %d | IP: %s",
                now()->toDateTimeString(),
                $this->identifyBot($userAgent),
                $request->fullUrl(),
                $response->getStatusCode(),
                $request->ip()
            );

            Log::info("SEARCH_ENGINE_BOT: " . $logData);
        }

        return $response;
    }

    /**
     * Check if the User-Agent belongs to a search engine bot.
     */
    private function isSearchEngineBot(string $userAgent): bool
    {
        $bots = ['Googlebot', 'bingbot', 'YandexBot', 'DuckDuckGoBot', 'Baiduspider', 'Sogou', 'Slurp'];
        foreach ($bots as $bot) {
            if (stripos($userAgent, $bot) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Identify the primary name of the search engine bot.
     */
    private function identifyBot(string $userAgent): string
    {
        if (stripos($userAgent, 'Googlebot') !== false) return 'Googlebot';
        if (stripos($userAgent, 'bingbot') !== false) return 'Bingbot';
        if (stripos($userAgent, 'YandexBot') !== false) return 'YandexBot';
        if (stripos($userAgent, 'DuckDuckGoBot') !== false) return 'DuckDuckGoBot';
        if (stripos($userAgent, 'Baiduspider') !== false) return 'Baiduspider';
        if (stripos($userAgent, 'Slurp') !== false) return 'YahooSlurp';
        return 'OtherBot';
    }
}
