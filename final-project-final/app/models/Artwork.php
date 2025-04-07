<?php

namespace app\models;

class Artwork extends Model {
    protected $table = 'artworks';

    public function getAllArtworks() {
        return $this->query("SELECT * FROM {$this->table} ORDER BY year DESC, title ASC");
    }

    public function getArtworksByYear($year) {
        $sql = "SELECT * FROM {$this->table} WHERE year = ? ORDER BY title ASC";
        return $this->query($sql, [$year]);
    }

    public function getArtworksByClass($class) {
        $sql = "SELECT * FROM {$this->table} WHERE class_name = ? ORDER BY year DESC, title ASC";
        return $this->query($sql, [$class]);
    }

    public function getArtworkById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $result = $this->query($sql, [$id]);
        return $result[0] ?? null;
    }

    public function createArtwork($data) {
        $fields = array_keys($data);
        $values = array_values($data);
        $placeholders = str_repeat('?,', count($fields) - 1) . '?';
        
        $sql = "INSERT INTO {$this->table} (" . implode(',', $fields) . ") VALUES ($placeholders)";
        return $this->query($sql, $values);
    }

    public function updateArtwork($id, $data) {
        $fields = array_keys($data);
        $values = array_values($data);
        $values[] = $id;
        
        $setClause = implode('=?,', $fields) . '=?';
        $sql = "UPDATE {$this->table} SET $setClause WHERE id = ?";
        
        return $this->query($sql, $values);
    }

    public function deleteArtwork($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id]);
    }
} 