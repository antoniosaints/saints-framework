<?php

namespace App\Core\Database;

use Exception;
use PDO;
use PDOException;

class Database
{
    private static $connection;

    // Método para estabelecer a conexão com o banco de dados
    public static function connect($adapter, $host, $dbname, $port, $user, $password, $charset)
    {
        try {
            self::$connection = new PDO("$adapter:host=$host;dbname=$dbname;port=$port;charset=$charset", $user, $password);
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
        $config = [
            'adapter' => $group['adapter'] ?? 'mysql',
            'host' => $group['host'] ?? 'localhost',
            'name' => $group['name'],
            'port' => $group['port'] ?? 3306,
            'user' => $group['user'] ?? 'root',
            'pass' => $group['pass'],
            'charset' => $group['charset'] ?? 'utf8mb4',
        ];

        self::connect(...array_values($config));

        return self::$connection;
    }
}
