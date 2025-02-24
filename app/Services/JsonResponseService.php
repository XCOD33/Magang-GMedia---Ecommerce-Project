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
    public function success($message, $data = null): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        return response()->json($response);
    }

    /**
     * Returns a JSON response with an error status.
     *
     * @param string $message The error message to include in the response.
     * @param mixed|null $data Optional data to include in the response.
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($message, $data = null): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        return response()->json($response);
    }
}
