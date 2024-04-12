<?php
namespace App\Controllers\Usuarios;

use App\Controllers\BaseController;
use App\Core\Http\ErrorHandler;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Models\UsuarioModel;
use App\Schemas\UsuariosSchema;
use Exception;

class UsuariosController extends BaseController
{

    public function __construct(
        protected $UsuarioModel = new UsuarioModel()
    ){}
    public function Create(Request $request, Response $response)
    {
        try { // Instanciando o Model
            $Post = $request::getJson();
            $dataValidada = self::validateSchema(UsuariosSchema::createUser(), $Post);
            $usuarioSave = $this->UsuarioModel->save($dataValidada);
            $response::json([ // Retorna os dados no formato JSON
                'message' => "Usuário criado com sucesso",
                'id'      => $usuarioSave
            ], 200);
        }
        catch (Exception $e) { // Tratamento de erro
            ErrorHandler::handle($e); // Chama o tratamento de erro
        }
    }

    public function getJson($_, Response $response)
    {
        try {
            $response::json([
                "data" => $this->UsuarioModel->find()
            ]);
        }catch (Exception $e) {
            ErrorHandler::handle($e);
        }
    }
}