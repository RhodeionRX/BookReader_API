<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Event\Code\Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiException extends Exception
{
    public static function Error($e) : static
    {
        return new self(
            $e->getMessage() ?: 'Unknown error',
            $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
