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
            $dbname = 'art_portfolio';  // Make sure this matches your database name
            $user = 'root';
            $pass = 'root';
            $socket = '/Applications/MAMP/tmp/mysql/mysql.sock';  // MAMP MySQL socket

            // Log connection attempt
            error_log("Attempting database connection with settings:");
            error_log("Host: $host, Port: $port, Database: $dbname");

            // Create PDO instance with MAMP settings
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;unix_socket=$socket";
            error_log("DSN: $dsn");

            $this->db = new PDO(
                $dsn,
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
            error_log("Database connection successful!");
        } catch (PDOException $e) {
            // Log the detailed error
            error_log("Database Connection Error Details: " . $e->getMessage());
            error_log("Error Code: " . $e->getCode());
            error_log("Stack Trace: " . $e->getTraceAsString());
            throw new \Exception("Database connection failed. Please check error logs for details.");
        }
    }

    protected function query($sql, $params = []) {
        try {
            error_log("Executing SQL: " . $sql);
            error_log("Parameters: " . print_r($params, true));
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            
            error_log("Query executed successfully");
            return $stmt;
        } catch (PDOException $e) {
            error_log("Query Error: " . $e->getMessage());
            error_log("SQL: " . $sql);
            error_log("Parameters: " . print_r($params, true));
            throw new \Exception("Database query failed: " . $e->getMessage());
        }
    }

    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $result = $this->query($sql, [$id]);
        return $result->fetch();
    }

    public function all() {
        try {
            error_log("Attempting to fetch all records from table: {$this->table}");
            $sql = "SELECT * FROM {$this->table}";
            $result = $this->query($sql)->fetchAll();
            error_log("Found " . count($result) . " records");
            return $result;
        } catch (\Exception $e) {
            error_log("Error in all() method: " . $e->getMessage());
            throw $e;
        }
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