<?php

namespace App\Core;

use App\Core\Http\Request;
use App\Core\Http\Response;

class Core
{
    public static function dispatch(array $routes)
    {
        $is_http_method = false;
        $is_routed = false;
        $url = isset($_GET['url']) ? '/' . trim($_GET['url'], '/') : '/';
        $prefixController = "App\\Controllers\\";

        foreach ($routes as $route) {
            $pattern = "#^" . preg_replace("/{id}/", "([\w-]+)", $route['path']) . "$#";
            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);
                $is_routed = true;

                if ($route['method'] === Request::method()) {
                    $is_http_method = true;
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
        }

        if (!$is_routed) {
            self::handleNotFound('Rota não encontrada');
            return;
        }

        if (!$is_http_method) {
            self::handleMethodNotAllowed();
            return;
        }
        
    }

    private static function handleMethodNotAllowed()
    {
        Response::json([
            'message' => 'Método HTTP inválido'
        ], 405);
    }

    private static function handleNotFound($message)
    {
        Response::json([
            'message' => $message
        ], 404);
    }
}
