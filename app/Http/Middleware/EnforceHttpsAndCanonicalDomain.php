<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforceHttpsAndCanonicalDomain
{
    /**
     * Handle an incoming request to enforce HTTPS and non-WWW canonical domain via 1-hop 301 Redirect.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = strtolower($request->getHost());

        // Only enforce on production domains or when domain contains rooteraplumbing.id
        if (str_contains($host, 'rooteraplumbing.id')) {
            $isWww = str_starts_with($host, 'www.');
            $isHttp = !$request->secure() && $request->header('X-Forwarded-Proto') !== 'https';

            if ($isWww || $isHttp) {
                $canonicalHost = 'rooteraplumbing.id';
                $targetUrl = 'https://' . $canonicalHost . $request->getRequestUri();
                return redirect()->away($targetUrl, 301);
            }
        }

        return $next($request);
    }
}
