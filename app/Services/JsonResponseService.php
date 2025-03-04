<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class JsonResponseService
{
    /**
     * Returns a JSON response with a successful status.
     *
     * @param string $message The success message to include in the response.
     * @param mixed|null $data Optional data to include in the response.
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($message, $data = null, $statusCode = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Returns a JSON response with an error status.
     *
     * @param string $message The error message to include in the response.
     * @param mixed|null $data Optional data to include in the response.
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($message, $data = null, $statusCode = 400, $errors = []): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    public function unauthorized($message = 'Unauthorized', $data = null): JsonResponse
    {
        return $this->error($message, $data, 401);
    }

    public function notFound($message = 'Not Found', $data = null): JsonResponse
    {
        return $this->error($message, $data, 404);
    }

    public function serverError($message = 'Server Error', $data = null): JsonResponse
    {
        return $this->error($message, $data, 500);
    }
}
