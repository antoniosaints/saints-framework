<?php

namespace App\Core\Database;

use Exception;
use PDO;
use PDOException;

class Database {
    private static $connection;

    // Construtor privado para evitar instanciação direta
    private function __construct() {}

    // Método para estabelecer a conexão com o banco de dados
    public static function connect($host, $dbname, $user, $password) {
        try {
            self::$connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Erro ao conectar ao banco de dados: " . $e->getMessage(), 500);
        }
    }

    // Método para obter a conexão com o banco de dados
    public static function getConnection(string $dbGroup = "default")
    {
        $config = new Config();
        $group = $config->connections[$dbGroup] ?? $config->connections['default'];
        
        // Verifica se a conexão já foi estabelecida, se não, estabelece
        if (!isset(self::$connection)) {
            self::connect($group['host'], $group['dbname'], $group['user'], $group['password']);
        }
        return self::$connection;
    }
}
