<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception): JsonResponse
{
    // Validation Exception handling
    if ($exception instanceof ValidationException) {
        return response()->json([
            'status' => false,
            'message' => 'Validation failed',
            'response_data' => [],
            'error_data' => $exception->errors(),
        ], 422);
    }

    // Handle the AuthenticationException (unauthenticated)
    if ($exception instanceof AuthenticationException) {
        return $this->unauthenticated($request, $exception);
    }

    // Handle generic 401 errors (often from Sanctum or Passport)
    if ($exception instanceof \Illuminate\Http\Exceptions\HttpResponseException && $exception->getResponse()->getStatusCode() === 401) {
        return response()->json([
            'status' => false,
            'message' => 'Authentication failed.',
            'response_data' => [],
            'error_data' => 'You must be logged in to access this resource.',
        ], 401);
    }

    // Default fallback to parent
    return parent::render($request, $exception);
}



    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $guard = $exception->guards()[0] ?? null;

        return response()->json([
            'status' => false,
            'message' => 'Unauthenticated',
            'response_data' => [],
            'error_data' => match($guard) {
                'admin' => 'Admin access required.',
                default => 'Authentication failed. Please log in again.',
            },
        ], 401);
    }
    
}
