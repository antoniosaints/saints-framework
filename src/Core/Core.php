<?php

namespace App\Core;

use App\Http\Request;
use App\Http\Response;

class Core
{
    public static function dispatch(array $routes)
    {
        $url = "/";
        $prefixController = "App\\Controllers\\";

        isset($_GET['url']) && $url .= $_GET['url'];
        $url !== "/" && $url = rtrim($url, "/");

        foreach ($routes as $route) {
            $pattern = "#^" . preg_replace("/{id}/", "([\w-]+)", $route['path']) . "$#";
            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                if ($route['method'] !== Request::method()) {
                    Response::json([
                        'message' => 'Método HTTP inválido',
                        'status'  => 405
                    ], 405);
                    return;
                }

                [$controller, $action] = explode('::', $route['action']);
                $controllerName = $prefixController . $controller;
                if (class_exists($controllerName)) {
                    $instance = new $controllerName();
                    if (method_exists($instance, $action)) {
                        $instance->$action(new Request, new Response, $matches);
                        return;
                    } else {
                        Response::json([
                            'message' => 'Método não encontrado',
                            'status'  => 404
                        ], 404);
                        return;
                    }
                } else {
                    Response::json([
                        'message' => 'Controller não encontrado',
                        'status'  => 404
                    ], 404);
                    return;
                }
            }
        }
        Response::json([
            'message' => 'Rota não encontrada',
            'status'  => 404
        ], 404);
    }
}
