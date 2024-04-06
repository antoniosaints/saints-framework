<?php
namespace App\Controllers\Usuarios;

use App\Controllers\BaseController;
use App\Http\ErrorHandler;
use App\Models\UsuarioModel;
use App\Schemas\UsuariosSchema;
use App\Validators\DatabaseValidator;
use Exception;

class UsuariosController extends BaseController
{
    public function Create($request, $response)
    {
        try {
            $Model = new UsuarioModel();
            $body = $request::getJson();
            $data = DatabaseValidator::validate(UsuariosSchema::createUser(), $body);
            $user = $Model->save($data);
            $response::json([
                'message' => 'Usuário criado com sucesso',
                'id'      => $user,
                'status'  => 200
            ], 200);
        }catch (Exception $e) {
            ErrorHandler::handle($e);
        }
    }
}