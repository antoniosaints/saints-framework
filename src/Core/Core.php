<?php
namespace App\Core;

use App\Http\Request;
use App\Http\Response;

class Core
{
    public static function dispatch(array $routes)
    {
        $url = isset($_GET['url']) ? '/' . trim($_GET['url'], '/') : '/';
        $prefixController = "App\\Controllers\\";

        foreach ($routes as $route) {
            $pattern = "#^" . preg_replace("/{id}/", "([\w-]+)", $route['path']) . "$#";
            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                if ($route['method'] !== Request::method()) {
                    self::handleMethodNotAllowed();
                    return;
                }

                [$controller, $action] = explode('::', $route['action']);
                $controllerName = $prefixController . str_replace("/", "\\", $controller);
                
                if (class_exists($controllerName)) {
                    $instance = new $controllerName();
                    if (method_exists($instance, $action)) {
                        $instance->$action(new Request(), new Response());
                        return;
                    } else {
                        self::handleNotFound('Método não encontrado');
                        return;
                    }
                } else {
                    self::handleNotFound('Controller não encontrado');
                    return;
                }
            }
        }
        
        self::handleNotFound('Rota não encontrada');
    }

    private static function handleMethodNotAllowed()
    {
        Response::json([
            'message' => 'Método HTTP inválido',
            'status'  => 405
        ], 405);
    }

    private static function handleNotFound($message)
    {
        Response::json([
            'message' => $message,
            'status'  => 404
        ], 404);
    }
}
