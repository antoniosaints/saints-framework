<?php
namespace App\Controllers\Usuarios;

use App\Controllers\BaseController;
use App\Schemas\UsuariosSchema;
use App\Validators\DatabaseValidator;
use Exception;

class UsuariosController extends BaseController
{
    public function Create()
    {
        $data = $this->request::getJson();
        try {
            $data_validate = DatabaseValidator::validate(UsuariosSchema::createUser(), $data);
            $this->response::json([
                'data' => $data_validate,
                'status' => 200
            ]);
        }catch (Exception $e) {
            $this->response::json([
                'message' => $e->getMessage(),
                'status'  => 400
            ], 404);
        }
    }
}