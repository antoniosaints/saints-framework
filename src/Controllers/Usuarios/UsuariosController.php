<?php
namespace App\Controllers\Usuarios;

use App\Controllers\BaseController;

class UsuariosController extends BaseController
{
    public function index()
    {
        $data = $this->request::getBody();

        $this->response::json($data);
    }
}