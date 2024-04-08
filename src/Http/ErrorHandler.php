<?php

namespace App\Http;

use Exception;
use Throwable;
use PDOException;

class ErrorHandler
{
    public static function handle(Throwable $exception, Response $response = null)
    {
        if ($response === null) {
            $response = new Response();
        }

        $statusCode = $exception->getCode();

        if ($exception instanceof PDOException) {
            // Lidar especificamente com exceções do PDO
            $code = 500; // Ou outro código de erro interno do servidor
        } elseif ($exception instanceof Exception) {
            // Se for uma instância de Exception padrão
            $code = $exception->getCode();
        } else {
            // Lidar com outros tipos de exceção aqui
        }

        http_response_code($code);

        $response::json([
            'message' => $exception->getMessage(),
            'status' => $statusCode
        ], $code);
    }
}
