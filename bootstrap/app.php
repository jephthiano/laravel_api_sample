<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();


// use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
// use Illuminate\Foundation\Application;

// $app = new Application(
//     $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
// );

// // Register routes (routes are loaded automatically by Laravel when the app is initialized)
// $app->router->group([
//     'namespace' => 'App\\Http\\Controllers',
// ], function ($router) {
//     // Load the route files
//     require __DIR__.'/../routes/web.php';
//     require __DIR__.'/../routes/api.php';
//     require __DIR__.'/../routes/console.php';
// });

// // Register middleware
// $app->middleware([
//     EnsureFrontendRequestsAreStateful::class, // Add Sanctum middleware globally
// ]);

// // Set up exception handling (Laravel automatically does this, but you can customize it here if necessary)
// $app->withExceptionHandling(function ($exceptions) {
//     // You can add custom exception handling here
// });

// // Define health check route
// $app->get('/up', function () {
//     return response('OK', 200);
// });

// // Finally, return the app instance
// return $app;