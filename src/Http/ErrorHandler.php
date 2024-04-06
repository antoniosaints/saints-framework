<?php
namespace App\Http;

use Throwable;

class ErrorHandler
{
    public static function handle(Throwable $exception, Response $response = new Response())
    {
        if ($exception instanceof \Exception) {
            http_response_code($exception->getCode());
        }

        $response::json([
            'message' => $exception->getMessage(),
            'code' => $exception->getCode()
        ], $exception->getCode());
    }
}