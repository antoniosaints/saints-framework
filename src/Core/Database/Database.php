<?php

namespace App\Core\Database;

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
            // Tratamento de exceções
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
            exit(); // Encerra o script em caso de erro
        }
    }

    // Método para obter a conexão com o banco de dados
    public static function getConnection() {
        // Verifica se a conexão já foi estabelecida, se não, estabelece
        if (!isset(self::$connection)) {
            self::connect('localhost', 'saintsmvc', 'root', '');
        }
        return self::$connection;
    }
}
