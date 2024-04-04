<?php

namespace App\Http;

class Route
{
    private static $routes = [];

    public static function get(string $path, string $action)
    {
        self::$routes[] = [
            'action' => $action,
            'path'   => $path,
            'method' => 'GET'
        ];
    }

    public static function post(string $path, string $action)
    {
        self::$routes[] = [
            'action' => $action,
            'path'   => $path,
            'method' => 'POST'
        ];
    }

    public static function put(string $path, string $action)
    {
        self::$routes[] = [
            'action' => $action,
            'path'   => $path,
            'method' => 'PUT'
        ];
    }

    public static function delete(string $path, string $action)
    {
        self::$routes[] = [
            'action' => $action,
            'path'   => $path,
            'method' => 'DELETE'
        ];
    }

    public static function routes()
    {
        return self::$routes;
    }
}