<?php

namespace App\Http\Requests;

use App\Exceptions\CustomApiException;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
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
        if ($e instanceof ValidationException) {
            return $this->sendResponse([], 'Validation failed', false, $e->errors(), 422);
        }

        if ($e instanceof CustomApiException) {
            $error = $e->getErrorData() ?? [];

            return $this->sendResponse([], $e->getMessage(), false, $error, $e->getStatus());
        }

        $errorData = (env('APP_ENV') === 'local' || env('APP_ENV') === 'development') ? ['error' => $e->getMessage()] : [];

        return $this->sendResponse([], 'Something went wrong', false, $errorData, 500);
    }

    /**
     * Override failed validation to use sendResponse
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->sendResponse([], 'Validation failed', false, $validator->errors(), 422)
        );
    }

    /**
     * Manually trigger an error.
     */
    public function triggerError($message, $details = [])
    {
        throw new CustomApiException($message, 403, $details);
    }
}
