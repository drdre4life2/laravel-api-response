<?php

namespace Drdre4life2\ApiResponse\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

trait HasApiResponse
{
    public function okResponse(string $message, $data = null): JsonResponse
    {
        return $this->successResponse($message, $data, 200);
    }

    public function successResponse(string $message, $data = null, int $status = 200): JsonResponse
    {
        return $this->jsonResponse($message, $status, $data);
    }

    public function jsonResponse(string $message, int $status, $data = null): JsonResponse
    {
        $is_successful = $this->isStatusCodeSuccessful($status);

        $response_data = [
            'status' => $is_successful,
            'message' => $message,
        ];

        if (! is_null($data)) {
            $response_data[$is_successful ? 'data' : 'error'] = $data;
        }

        return Response::json($response_data, $status);
    }

    public function isStatusCodeSuccessful(int $status): bool
    {
        return $status >= 200 && $status < 300;
    }

    public function createdResponse(string $message, $data = null): JsonResponse
    {
        return $this->successResponse($message, $data, 201);
    }

    public function clientErrorResponse(string $message, int $status = 400, $error = null): JsonResponse
    {
        return $this->jsonResponse($message, $status, $error);
    }

    public function serverErrorResponse(string $message, int $status = 500, ?\Throwable $exception = null): JsonResponse
    {
        if ($exception !== null) {
            Log::error("{$exception->getMessage()} on line {$exception->getLine()} in {$exception->getFile()}");
        }

        return $this->jsonResponse($message, $status);
    }
}
