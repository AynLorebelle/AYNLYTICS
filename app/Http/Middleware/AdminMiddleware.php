<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in and is an admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admins only.');
        }

        return $next($request);
    }
}