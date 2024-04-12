<?php
namespace App\Core\Http;

class Response 
{
    public static function json(array|string|bool|null $data = [], int $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Powered-By: saints-framework');
        if (!array_key_exists("status", $data)) {
            $data["status"] = $code;
        }
        echo json_encode($data);
    }
}