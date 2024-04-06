<?php

namespace App\Controllers;

use App\Http\ErrorHandler;
use App\Http\Request;
use App\Http\Response;
use Exception;

class ControllerExample extends BaseController
{
    public function getJson(Request $request, Response $response) // Declare os métodos com injeção de dependência
    {
        try {
            $data = $request::getJson(); // Recebe os dados do JSON enviados
            $response::json($data); // Envia os dados como JSON para o cliente
        }catch (Exception $e) {
            ErrorHandler::handle($e); // Tratamento de erro
        }
    }
}