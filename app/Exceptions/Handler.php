<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler
{
    public static function handleNotFoundHttpException(HttpException $exception, Request $request): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $exception->getMessage() ?: 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    public static function handleException(Throwable $e, Request $request): JsonResponse
    {
        $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
        return response()->json([
            'success' => false,
            'message' => $e->getMessage() ?: 'An unexpected error occurred.',
        ], $status);
    }
}
