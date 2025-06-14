<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->user() || ! auth()->user()->isAdmin()) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        return $next($request);
    }
}
