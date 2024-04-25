<?php

namespace App\Core\Http;

class Route
{
    private static $routes = [];
    private static $currentGroupMiddleware = [];

    public static function get(string $path, string $action)
    {
        self::$routes[] = [
            'action' => $action,
            'path'   => $path,
            'method' => 'GET',
            'middleware' => self::$currentGroupMiddleware
        ];
    }

    public static function post(string $path, string $action)
    {
        self::$routes[] = [
            'action' => $action,
            'path'   => $path,
            'method' => 'POST',
            'middleware' => self::$currentGroupMiddleware
        ];
    }

    public static function put(string $path, string $action)
    {
        self::$routes[] = [
            'action' => $action,
            'path'   => $path,
            'method' => 'PUT',
            'middleware' => self::$currentGroupMiddleware
        ];
    }

    public static function delete(string $path, string $action)
    {
        self::$routes[] = [
            'action' => $action,
            'path'   => $path,
            'method' => 'DELETE',
            'middleware' => self::$currentGroupMiddleware
        ];
    }

    public static function middleware(string $middleware)
    {
        self::$currentGroupMiddleware[] = $middleware;
    }

    public static function group($callback)
    {
        $oldMiddleware = self::$currentGroupMiddleware;
        call_user_func($callback);
        self::$currentGroupMiddleware = $oldMiddleware;
    }


    public static function routes()
    {
        return self::$routes;
    }
}
