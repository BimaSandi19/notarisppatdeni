<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Cache Control Headers
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        // Mencegah clickjacking attack
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Mencegah MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // XSS Protection (untuk browser lama)
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Referrer Policy - jangan kirim referrer ke situs lain
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions Policy - disable fitur yang tidak perlu
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // Content Security Policy - proteksi XSS tingkat lanjut
        if (app()->environment('production')) {
            $response->headers->set(
                'Content-Security-Policy',
                "default-src 'self'; " .
                    "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://code.iconify.design; " .
                    "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com; " .
                    "font-src 'self' https://fonts.gstatic.com https://cdn.jsdelivr.net; " .
                    "img-src 'self' data: https:; " .
                    "connect-src 'self';"
            );
        }

        return $response;
    }
}
