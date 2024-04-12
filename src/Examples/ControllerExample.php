<?php

namespace App\Controllers;

use App\Core\Http\ErrorHandler;
use App\Core\Http\Request;
use App\Core\Http\Response;
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