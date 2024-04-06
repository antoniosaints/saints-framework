<?php

namespace App\Schemas;

class UsuariosSchema
{
    public static function createUser()
    {
        return [
            "nome"     => "required|string",
            "idade"    => "required|integer",
            "senha"    => "required|string",
        ];
    }
}