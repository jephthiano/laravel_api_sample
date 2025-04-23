<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJsonResponse
{
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
// This middleware forces the response to be in JSON format by setting the Accept header to application/json.
// You can register this middleware in your app/Http/Kernel.php file under the $middlewareGroups array for the API group.
