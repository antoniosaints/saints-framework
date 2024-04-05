<?php
namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

class BaseController {

    public static function request()
    {
        return new Request();
    }

    public static function responseJson($data = null, $status = 200)
    {
        $response = new Response();
        $response::json($data, $status);
    }
}