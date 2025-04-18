<?php

namespace app\models;

use PDO;
use PDOException;

class Artwork extends Model {
    protected $table = 'artworks';

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        return $this->all();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function getByClass($class) {
        $sql = "SELECT * FROM {$this->table} WHERE class = ? ORDER BY created_at DESC";
        return $this->query($sql, [$class]);
    }

    public function getClasses() {
        $sql = "SELECT DISTINCT class_name FROM {$this->table} WHERE class_name IS NOT NULL ORDER BY class_name ASC";
        $result = $this->query($sql);
        return $result->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * Get a list of unique, non-null class names.
     */
    public function getUniqueClasses() {
        $sql = "SELECT DISTINCT class_name FROM {$this->table} WHERE class_name IS NOT NULL AND class_name != '' ORDER BY class_name ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function createArtwork($data) {
        $fields = array_keys($data);
        $values = array_values($data);
        $placeholders = str_repeat('?,', count($fields) - 1) . '?';
        
        $sql = "INSERT INTO {$this->table} (" . implode(',', $fields) . ") VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }

    public function updateArtwork($id, $data) {
        $fields = array_keys($data);
        $values = array_values($data);
        $values[] = $id;
        
        $setClause = implode('=?,', $fields) . '=?';
        $sql = "UPDATE {$this->table} SET $setClause WHERE id = ?";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }

    public function deleteArtwork($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function where($column, $value) {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} = ?";
        return $this->query($sql, [$value])->fetchAll();
    }
} 