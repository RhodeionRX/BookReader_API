<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ApiException extends Exception
{
    public static function Error(string $message, int $statusCode) : static
    {
        return new self(
            $message ?: 'Unknown error',
            $statusCode ?: Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
