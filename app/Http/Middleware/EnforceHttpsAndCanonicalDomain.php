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

        // Never enforce redirect in local environment or on local hosts
        if (app()->environment('local') 
            || in_array($host, ['127.0.0.1', 'localhost']) 
            || str_ends_with($host, '.test')
            || str_ends_with($host, '.local')
            || str_ends_with($host, '.laragon')) {
            return $next($request);
        }

        $canonicalHost = 'rooteraplumbing.id';
        $isNotCanonical = ($host !== $canonicalHost);
        $isHttp = !$request->secure() && $request->header('X-Forwarded-Proto') !== 'https';

        if ($isNotCanonical || $isHttp) {
            $targetUrl = 'https://' . $canonicalHost . $request->getRequestUri();
            return redirect()->away($targetUrl, 301);
        }

        return $next($request);
    }
}
