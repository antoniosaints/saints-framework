<?php
namespace App\Controllers;

use App\Validators\DatabaseValidator;

/**
 * Base Controller
 * @author Antonio
 * @package App\Controllers
 * @version 1.0.0
 * Defina os métodos públicos para usar em todos os controllers que extenderem o BaseController
 */
class BaseController {

    public static function validateSchema($schema, $data)
    {
        return DatabaseValidator::validate($schema, $data);
    }
}