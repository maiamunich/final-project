<?php

namespace app\models;

use PDO;
use PDOException;

class Model {
    protected $db;
    protected $table;

    public function __construct() {
        try {
            // MAMP default settings
            $host = 'localhost';
            $port = '8889';  // MAMP MySQL port
            $dbname = getenv('DB_NAME');
            $user = 'root';
            $pass = 'root';
            $socket = '/Applications/MAMP/tmp/mysql/mysql.sock';  // MAMP MySQL socket

            // Create PDO instance with MAMP settings
            $this->db = new PDO(
                "mysql:host=$host;port=$port;dbname=$dbname;unix_socket=$socket",
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            // Log the error but don't expose details to the user
            error_log("Database Connection Error: " . $e->getMessage());
            throw new \Exception("Database connection failed. Please check your configuration.");
        }
    }

    protected function query($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Query Error: " . $e->getMessage());
            throw new \Exception("Database query failed.");
        }
    }

    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $result = $this->query($sql, [$id]);
        return $result->fetch(PDO::FETCH_ASSOC) ?? null;
    }

    public function all() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $fields = array_keys($data);
        $values = array_values($data);
        $placeholders = str_repeat('?,', count($fields) - 1) . '?';
        
        $sql = "INSERT INTO {$this->table} (" . implode(',', $fields) . ") VALUES ($placeholders)";
        $this->query($sql, $values);
        return $this->db->lastInsertId();
    }

    public function update($id, $data) {
        $fields = array_keys($data);
        $values = array_values($data);
        $values[] = $id;
        
        $setClause = implode('=?,', $fields) . '=?';
        $sql = "UPDATE {$this->table} SET $setClause WHERE id = ?";
        
        return $this->query($sql, $values);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id]);
    }
}