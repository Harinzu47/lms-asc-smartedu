<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     * Add security headers to prevent common attacks.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent Clickjacking - Disallow embedding in iframes from other domains
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Prevent MIME sniffing - Browser won't try to guess content type
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Control referrer information sent to other sites
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Prevent XSS attacks in older browsers
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        return $response;
    }
}
