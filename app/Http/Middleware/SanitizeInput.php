<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SanitizeInput
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
        // Sanitize semua input (kecuali password)
        $input = $request->except(['password', 'password_confirmation', 'current_password']);

        array_walk_recursive($input, function (&$value) {
            if (is_string($value)) {
                // Strip tags HTML untuk mencegah XSS
                $value = strip_tags($value);

                // Trim whitespace
                $value = trim($value);
            }
        });

        $request->merge($input);

        return $next($request);
    }
}
