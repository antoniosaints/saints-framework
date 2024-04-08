<?php
namespace App\Controllers\Usuarios;

use App\Controllers\BaseController;
use App\Http\ErrorHandler;
use App\Http\Request;
use App\Http\Response;
use App\Models\UsuarioModel;
use App\Schemas\UsuariosSchema;
use Exception;

class UsuariosController extends BaseController
{
    public function Create(Request $request, Response $response)
    {
        try {
            $Model = new UsuarioModel(); // Instanciando o Model
            $body = $request::getJson(); // Recebe os dados do JSON enviados
            $data = self::validateSchema(UsuariosSchema::createUser(), $body); // Valida os dados do JSON
            $user = $Model->save($data); // Salva os dados no Model
            $response::json([ // Retorna os dados no formato JSON
                'message' => 'Usuário criado com sucesso',
                'id'      => $user,
                'status'  => 200
            ], 200);
        }catch (Exception $e) { // Tratamento de erro
            ErrorHandler::handle($e); // Chama o tratamento de erro
        }
    }
}