<?php

namespace App\Schemas;

class UsuariosSchema
{
    public static function createUser()
    {
        return [
            "nome"     => "required|string",
            "idade"    => "integer",
            "senha"    => "required|string",
        ];
    }
}