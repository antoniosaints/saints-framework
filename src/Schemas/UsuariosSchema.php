<?php

namespace App\Schemas;

class UsuariosSchema
{
    public static function createUser()
    {
        return [
            "nome" => "required|string",
            "email" => "string|email",
            "password" => "required|string",
            "cpf" => "required|string",
            "data_nascimento" => "required|string",
            "sexo" => "required|string",
        ];
    }
}