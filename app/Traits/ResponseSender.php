<?php

namespace App\Traits;

trait ResponseSender
{
    /**
     * Send response
     * @param array|object $data
     * @param string $message
     * @param integer $status_code
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse(array|object|bool $data = [], string $message = '', int $status_code = 200, array $errors = []): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => $data,
                'errors' => $errors,
                'message' => $message,
            ],
            $status_code
        );
    }

    /**
     * Send error
     * @param array $errors
     * @param string $message
     * @param integer $status_code
     * @param array|null $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError(array $errors = [], string $message = '', int $status_code = 400, array $data = null): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            [
                'status' => 'error',
                'data' => $data,
                'errors' => $errors,
                'message' => $message
            ],
            $status_code
        );
    }
}
