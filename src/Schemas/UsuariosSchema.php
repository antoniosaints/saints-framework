<?php

namespace App\Schemas;

class UsuariosSchema
{
    public static function createUser()
    {
        return [
            "id"       => "integer",
            "nome"     => "required|string",
            "email"    => "required|email",
            "senha"    => "required|password",
        ];
    }
}