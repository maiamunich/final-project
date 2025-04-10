<?php

namespace app\models;

abstract class Model {
    protected $db;

    public function __construct() {
        $this->db = $this->connect();
    }

    public function findAll() {
        $query = "select * from $this->table";
        return $this->query($query);
    }

    private function connect() {
        $env = parse_ini_file(__DIR__ . '/../../.env');
        if (!$env) {
            throw new \Exception("Failed to load .env file");
        }

        // Split host and port if port is specified
        $hostParts = explode(':', $env['DBHOST']);
        $host = $hostParts[0];
        $port = isset($hostParts[1]) ? ';port=' . $hostParts[1] : '';

        $dsn = "mysql:host=" . $host . $port . ";dbname=" . $env['DBNAME'];
        try {
            return new \PDO($dsn, $env['DBUSER'], $env['DBPASS']);
        } catch (\PDOException $e) {
            throw new \Exception("Database connection failed: " . $e->getMessage());
        }
    }

    public function query($query, $data = []) {
        $stm = $this->db->prepare($query);
        $check = $stm->execute($data);
        if ($check) {
            //return as an associated array
            $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
            if (is_array($result) && count($result)) {
                return $result;
            }
        }
        return false;
    }

}