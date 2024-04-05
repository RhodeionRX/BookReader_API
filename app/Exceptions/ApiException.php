<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        //
    }

    public static function render(NotFoundHttpException $e, Request $request): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], $e->getCode() ?? Response::HTTP_NOT_FOUND);
    }

    public static function Error(int $statusCode, string $message)
    {
        return new self($message, $statusCode);
    }
}
