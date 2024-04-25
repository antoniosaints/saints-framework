<?php
namespace App\Middlewares;

use App\Core\Http\Request;
use App\Core\Http\Response;

class AuthMiddleware {
    public function handle(Request $request) {
        // Verificar se o usuário está autenticado
        if (!isset($_SESSION['user'])) {
            // Usuário não está autenticado, redirecionar para a página de login
            Response::html('<h1>Usuário não autenticado</h1>');
            exit();
        }
    }
}
