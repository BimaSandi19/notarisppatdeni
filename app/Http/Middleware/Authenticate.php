<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (Route::has('login')) {
                return route('login'); // Pastikan rute ini benar
            } else {
                // Tambahkan log untuk debugging
                Log::error('Route [login] not defined.');
                abort(404, 'Route [login] not defined.');
            }
        }
    }
}