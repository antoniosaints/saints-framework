<?php
namespace App\Core\Http;

class Response 
{
    public static function json(array|string|bool|null $data = [], int $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Powered-By: saints-framework');
        if (!array_key_exists("status", $data)) {
            $data["status"] = $code;
        }
        echo json_encode($data);
    }

    public static function html(string $html, int $code = 200)
    {
        http_response_code($code);
        header('Content-Type: text/html');
        header('Access-Control-Allow-Origin: *');
        header('Powered-By: saints-framework');
        echo $html;
    }

    public static function view(string $view, array $data = [], int $code = 200)
    {
        http_response_code($code);
        header('Content-Type: text/html');
        header('Access-Control-Allow-Origin: *');
        header('Powered-By: saints-framework');
        
        // Caminho completo para o arquivo de visualização
        $viewPath = __DIR__ . '/../../Views/' . $view . '.php';
        
        // Verifica se o arquivo de visualização existe
        if (file_exists($viewPath)) {
            // Extrai os dados para torná-los acessíveis na visualização
            extract($data);
            
            // Inclui o arquivo de visualização
            include $viewPath;
        } else {
            // Se o arquivo de visualização não existir, retorna uma mensagem de erro
            echo "Erro: O arquivo de visualização '$view.php' não foi encontrado.";
        }
    }
    
}