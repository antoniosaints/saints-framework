<?php
namespace App\Models;

use App\Core\Database\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $allowFields = [
        'nome',
        'idade',
        'senha'
    ];
}