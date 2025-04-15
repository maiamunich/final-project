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

    public function getByYear($year) {
        $sql = "SELECT * FROM {$this->table} WHERE year = ? ORDER BY created_at DESC";
        return $this->query($sql, [$year]);
    }

    public function getByClass($class) {
        $sql = "SELECT * FROM {$this->table} WHERE class = ? ORDER BY year DESC, created_at DESC";
        return $this->query($sql, [$class]);
    }

    public function getYears() {
        $sql = "SELECT DISTINCT year FROM {$this->table} ORDER BY year DESC";
        $result = $this->query($sql);
        return $result->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function getClasses() {
        $sql = "SELECT DISTINCT class FROM {$this->table} WHERE class IS NOT NULL ORDER BY class ASC";
        $result = $this->query($sql);
        return $result->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function createArtwork($data) {
        $fields = array_keys($data);
        $values = array_values($data);
        $placeholders = str_repeat('?,', count($fields) - 1) . '?';
        
        $sql = "INSERT INTO artworks (" . implode(',', $fields) . ") VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }

    public function updateArtwork($id, $data) {
        $fields = array_keys($data);
        $values = array_values($data);
        $values[] = $id;
        
        $setClause = implode('=?,', $fields) . '=?';
        $sql = "UPDATE artworks SET $setClause WHERE id = ?";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }

    public function deleteArtwork($id) {
        $sql = "DELETE FROM artworks WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function where($column, $value) {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} = ?";
        return $this->query($sql, [$value])->fetchAll();
    }
} 