<?php
date_default_timezone_set('America/Sao_Paulo');
// Verifica se a solicitação é uma solicitação OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Configura os cabeçalhos CORS permitidos para a resposta de preflight
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Max-Age: 86400'); // Cache por 1 dia

    // Termina a execução do script
    exit;
}

// Adicione este middleware antes de enviar qualquer resposta
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once __DIR__ . '/vendor/autoload.php';
<<<<<<< HEAD
=======
require_once __DIR__ . '/src/Core/Http/HeaderCheck.php';
>>>>>>> 3d485545d83e4c1cc5b11be721668636917046ef
require_once __DIR__ . '/src/Core/Helper/helper_core.php';

foreach (glob(__DIR__ . '/src/Routes/*.php') as $filename) {
    require_once $filename;
}

use App\Core\Core;
use App\Core\Http\Route;

Core::dispatch(Route::routes());
