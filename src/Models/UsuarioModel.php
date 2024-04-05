<?php
namespace App\Models;

use App\Core\Database\Model;

class UsuarioModel extends Model
{
    protected $table = 'users';
    protected $allowFields = [
        'nome',
        'idade',
        'senha'
    ];
}