<?php
namespace App\Examples;

use App\Core\Database\Model;

class ModelExample extends Model
{
    protected static $table = 'table_example';
    protected $allowFields = ['id', 'name'];
}