<?php

namespace app\models;

use PDO;
use PDOException;

class Model {
    protected $db;
    protected $table;

    public function __construct() {
        try {
            // Debug output at start of constructor
            error_log("Model constructor started");
            error_log("Current working directory: " . getcwd());
            
            // Check if environment variables are loaded
            $required_vars = ['DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_SOCKET'];
            $missing_vars = [];
            foreach ($required_vars as $var) {
                if (empty($_ENV[$var])) {
                    $missing_vars[] = $var;
                }
            }
            
            if (!empty($missing_vars)) {
                error_log("Missing required environment variables: " . implode(', ', $missing_vars));
                error_log("Current ENV vars: " . print_r($_ENV, true));
                throw new \Exception("Database configuration incomplete. Missing: " . implode(', ', $missing_vars));
            }

            // Get database credentials from environment variables
            $host = $_ENV['DB_HOST'];
            $port = $_ENV['DB_PORT'];
            $dbname = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $pass = $_ENV['DB_PASS'];
            $socket = $_ENV['DB_SOCKET'];

            // Log connection attempt
            error_log("Attempting database connection with settings:");
            error_log("Host: $host");
            error_log("Port: $port");
            error_log("Database: $dbname");
            error_log("Socket: $socket");
            error_log("User: $user");

            // First try socket connection
            try {
                $dsn = "mysql:unix_socket=$socket;dbname=$dbname";
                error_log("Trying socket connection with DSN: $dsn");
                
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
            } catch (PDOException $e) {
                // If socket connection fails, try TCP connection
                error_log("Socket connection failed, trying TCP connection");
                $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
                error_log("Trying TCP connection with DSN: $dsn");
                
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
            }
            
            error_log("Database connection successful!");
            
            // Verify connection by running a test query
            $this->db->query("SELECT 1");
            error_log("Test query successful");
            
        } catch (PDOException $e) {
            error_log("Database Connection Error Details:");
            error_log("Message: " . $e->getMessage());
            error_log("Code: " . $e->getCode());
            error_log("File: " . $e->getFile());
            error_log("Line: " . $e->getLine());
            error_log("Trace: " . $e->getTraceAsString());
            throw new \Exception("Database connection failed: " . $e->getMessage());
        } catch (\Exception $e) {
            error_log("Configuration Error:");
            error_log("Message: " . $e->getMessage());
            error_log("File: " . $e->getFile());
            error_log("Line: " . $e->getLine());
            throw $e;
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