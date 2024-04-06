<?php
namespace App\Repositories;

use App\Models\UsuarioModel;

class UsuariosRepository
{
    private static $Model;
    public function __construct()
    {
        self::$Model = new UsuarioModel();
    }

    public function findAll()
    {
        return self::$Model->findAll();
    }

    public function findById($id)
    {
        return self::$Model->findById($id);
    }

    public function findByEmail($email)
    {
        return self::$Model->where('email', $email)->find();
    }

    public function save($data)
    {
        return self::$Model->save($data);
    }

    public function delete($id)
    {
        return self::$Model->delete($id);
    }
}