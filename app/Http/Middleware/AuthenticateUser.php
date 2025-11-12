<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::check()) {
            abort(404); // Arahkan ke halaman 404 jika belum terautentikasi
        }

        $response = $next($request);

        // Mencegah caching halaman yang memerlukan autentikasi
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');

        return $response;
    }
}