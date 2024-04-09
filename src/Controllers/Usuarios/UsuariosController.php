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
            $Post = $request::getJson();
            $dataValidada = self::validateSchema(UsuariosSchema::createUser(), $Post);
            $usuarioSave = $Model->save($dataValidada);
            $response::json([ // Retorna os dados no formato JSON
                'message' => "Usuário criado com sucesso",
                'id'      => $usuarioSave,
                'status'  => 200
            ], 200);
        }
        catch (Exception $e) { // Tratamento de erro
            ErrorHandler::handle($e); // Chama o tratamento de erro
        }
    }

    public function getJson(Request $request, Response $response)
    {
        try {
            $Model = new UsuarioModel();
    
            $response::json([
                "data" => $Model->findAll(),
                "status"  => 200
            ], 200);
        }catch (Exception $e) {
            ErrorHandler::handle($e);
        }
    }
}