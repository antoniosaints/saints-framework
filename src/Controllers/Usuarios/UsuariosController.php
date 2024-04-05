<?php
namespace App\Controllers\Usuarios;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Schemas\UsuariosSchema;
use App\Validators\DatabaseValidator;
use Exception;

class UsuariosController extends BaseController
{
    public function __construct()
    {
        
    }
    public function Create()
    {
        try {
            $Model = new UsuarioModel();
            $data = self::request()::getJson();
            $dataValidated = DatabaseValidator::validate(UsuariosSchema::createUser(), $data);
            $usuarioCriado = $Model->save($dataValidated);
            self::responseJson($usuarioCriado, 201);
        }catch (Exception $e) {
            self::responseJson([
                'message' => $e->getMessage(),
                'status'  => 400
            ], 404);
        }
    }
}