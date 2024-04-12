<?php

namespace App\Core\Database;

use Exception;
use PDO;
use PDOException;

class Database
{
    private static $connection;

    // Construtor privado para evitar instanciação direta
    private function __construct()
    {
    }

    // Método para estabelecer a conexão com o banco de dados
    public static function connect($host, $dbname, $user, $password, $charset = 'utf8mb4')
    {
        try {
            self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $password);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Erro ao conectar ao banco de dados: " . $e->getMessage(), 500);
        }
    }

    // Método para obter a conexão com o banco de dados
    public static function getConnection(string $dbGroup = "development")
    {
        $phinxConfig = json_decode(file_get_contents(__DIR__ . '/../../../phinx.json'), true);

        // Obtém as configurações do ambiente especificado
        $group = $phinxConfig['environments'][$dbGroup] ?? $phinxConfig['environments']['development'];

        // Verifica se a conexão já foi estabelecida, se não, estabelece

        self::connect($group['host'], $group['name'], $group['user'], $group['pass'], $group['charset']);

        return self::$connection;
    }
}
