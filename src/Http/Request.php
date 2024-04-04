<?php

namespace App\Http;

class Request
{
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getBody()
    {
        $json = json_decode(file_get_contents('php://input'), true) ?? [];

        $data = match (self::method()) {
            'GET' => self::getGet(),
            'POST', 'PUT', 'DELETE' => $json,
            default => $json
        };

        return $data;
    }

    public static function getPost(string $key = null)
    {
        return $_POST[$key] ?? $_POST;
    }

    public static function getGet(string $key = null)
    {
        if (isset($_GET['url'])) {
            unset($_GET['url']);
        }
        
        return $_GET[$key] ?? $_GET;
    }
}
