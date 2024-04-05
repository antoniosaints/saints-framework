<?php
// Model.php

namespace App\Core\Database;

use Exception;
use PDO;

class Model
{
    protected $table;
    protected $primary = 'id';
    protected $allowFields = [];
    protected $wheres = [];

    public function __construct()
    {
        if (!$this->table) {
            throw new Exception("A propriedade table não foi definida na classe do modelo.");
        }
    }

    /**
     * Adiciona condições WHERE à consulta.
     *
     * @param string $column Coluna para a condição WHERE
     * @param mixed $value Valor para comparar
     * @return $this
     */
    public function where($column, $value)
    {
        $this->wheres[$column] = $value;
        return $this;
    }

    /**
     * Busca registros onde uma determinada coluna contenha um valor específico usando o operador LIKE.
     *
     * @param string $column A coluna na qual realizar a busca
     * @param mixed $value O valor a ser buscado
     * @return array|null Os resultados da busca em forma de array ou null se não houver resultados
     */
    public function findByLike(string $column, $value)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE $column LIKE :value";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->bindValue(':value', '%' . $value . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna os resultados se houver algum, caso contrário retorna null
        return $results ? $results : null;
    }

    /**
     * Executa uma consulta SELECT com as condições WHERE especificadas.
     *
     * @return array Resultados da consulta
     */
    public function find()
    {
        $whereClause = '';

        if (!empty($this->wheres)) {
            $whereClause = ' WHERE ';
            $conditions = [];

            foreach ($this->wheres as $column => $value) {
                $conditions[] = "$column = :$column";
            }

            $whereClause .= implode(' AND ', $conditions);
        }

        $query = "SELECT * FROM " . $this->table . $whereClause;
        $stmt = Database::getConnection()->prepare($query);

        foreach ($this->wheres as $column => $value) {
            $stmt->bindValue(":$column", $value);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Executa uma consulta SELECT para recuperar todos os registros.
     *
     * @return array Resultados da consulta
     */
    public function findAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = Database::getConnection()->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Executa uma consulta SELECT para recuperar um registro por ID.
     *
     * @param int $id ID do registro
     * @return array|false Resultado da consulta ou falso se não encontrado
     */
    public function findById($id)
    {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE " . $this->primary . " = :id";
            $stmt = Database::getConnection()->prepare($query);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Insere um novo registro na tabela.
     *
     * @param array $data Dados a serem inseridos
     * @return string|int ID do registro inserido ou mensagem de erro
     */
    public function save(array $data)
    {
        $columns = [];
        $values = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $this->allowFields)) {
                $columns[] = $key;
                $values[] = $value;
            }
        }

        $columnsStr = implode(',', $columns);
        $placeholders = implode(',', array_fill(0, count($columns), '?'));

        $query = "INSERT INTO " . $this->table . " ($columnsStr) VALUES ($placeholders)";
        $stmt = Database::getConnection()->prepare($query);
        $stmt->execute($values);

        return Database::getConnection()->lastInsertId();
    }

    /**
     * Exclui um registro da tabela por ID.
     *
     * @param int $id ID do registro a ser excluído
     * @return int Número de linhas afetadas (0 ou 1)
     */
    public function delete(int $id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE " . $this->primary . " = :id";
        $stmt = Database::getConnection()->prepare($query);
        $stmt->execute(['id' => $id]);

        return $stmt->rowCount();
    }

    /**
     * Executa uma consulta SQL personalizada.
     *
     * @param string $sql A consulta SQL a ser executada
     * @param array $params Parâmetros opcionais para a consulta (por padrão, vazio)
     * @return array|null Os resultados da consulta em forma de array ou null se não houver resultados
     */
    public function query(string $sql, array $params = [])
    {
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna os resultados se houver algum, caso contrário retorna null
        return $results ? $results : null;
    }
}
