<?php

namespace App\Services;

use Illuminate\Routing\Controller as Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use App\Exceptions\CustomApiException;
use Exception;

class BaseService
{
    protected function handleException(Exception $e): JsonResponse
    {
        // if ($e instanceof ValidationException) {
        //     return $this->sendResponse([], 'Validation failed', false, $e->errors(), 422);
        // }

        if ($e instanceof QueryException) {
            $errorData = (env('APP_ENV') === 'local' || env('APP_ENV') === 'development') ? ['error' => $e->getMessage()] : [];
            return $this->sendResponse([], 'Database error occurred', false, $errorData, 500);
        }

        if ($e instanceof CustomApiException) {
            $error = $e->getErrorData() ?? [];
            return $this->sendResponse([], $e->getMessage(), false, $error, $e->getStatus());
        }

        $errorData = (env('APP_ENV') === 'local' || env('APP_ENV') === 'development') ? ['error' => $e->getMessage()] : [];
        return $this->sendResponse([], 'Something went wrong', false, $errorData, 500);
    }
}
