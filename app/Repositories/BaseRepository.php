<?php

namespace App\Repositories;

use App\Exceptions\CustomApiException;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class BaseRepository
{
    protected function sendResponse($data, $message, $status = true, $error = [], $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'response_data' => $data,
            'error_data' => $error,
        ], $statusCode);
    }

    protected function handleException(Exception $e): JsonResponse
    {
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

    /**
     * Manually trigger an error.
     */
    public function triggerError($message, $details = [])
    {
        throw new CustomApiException($message, 403, $details);
    }
}
