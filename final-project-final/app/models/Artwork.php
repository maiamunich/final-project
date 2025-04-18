<?php

namespace app\models;

use PDO;
use PDOException;

class Artwork extends Model {
    protected $table = 'artworks';
    protected $fillable = [
        'title',
        'class_name',
        'image_url',
        'description',
        'medium',
        'dimensions',
        'price',
        'etsy_url'
    ];

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
        $sql = "SELECT * FROM {$this->table} WHERE class_name = :class_name";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['class_name' => $class]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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
        $sql = "SELECT DISTINCT class_name FROM {$this->table} WHERE class_name IS NOT NULL AND class_name != ''";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function validate($data) {
        $errors = [];

        // Required fields
        if (empty($data['title'])) {
            $errors['title'] = 'Title is required';
        }

        if (empty($data['image_url'])) {
            $errors['image_url'] = 'Image URL is required';
        }

        // Validate URL format
        if (!empty($data['image_url']) && !filter_var($data['image_url'], FILTER_VALIDATE_URL)) {
            $errors['image_url'] = 'Invalid image URL format';
        }

        if (!empty($data['etsy_url']) && !filter_var($data['etsy_url'], FILTER_VALIDATE_URL)) {
            $errors['etsy_url'] = 'Invalid Etsy URL format';
        }

        // Validate price if provided
        if (!empty($data['price']) && !is_numeric($data['price'])) {
            $errors['price'] = 'Price must be a number';
        }

        // Validate dimensions format if provided
        if (!empty($data['dimensions']) && !preg_match('/^\d+(\.\d+)?\s*x\s*\d+(\.\d+)?\s*(in|cm)$/i', $data['dimensions'])) {
            $errors['dimensions'] = 'Dimensions must be in format: "width x height in" or "width x height cm"';
        }

        return empty($errors) ? true : $errors;
    }

    public function createArtwork($data) {
        if ($errors = $this->validate($data)) {
            if ($errors !== true) {
                return ['success' => false, 'errors' => $errors];
            }
        }

        $sql = "INSERT INTO {$this->table} (title, class_name, image_url, description, medium, dimensions, price, etsy_url) 
                VALUES (:title, :class_name, :image_url, :description, :medium, :dimensions, :price, :etsy_url)";
        
        $stmt = $this->db->prepare($sql);
        $success = $stmt->execute([
            'title' => $data['title'],
            'class_name' => $data['class_name'] ?? null,
            'image_url' => $data['image_url'],
            'description' => $data['description'] ?? null,
            'medium' => $data['medium'] ?? null,
            'dimensions' => $data['dimensions'] ?? null,
            'price' => $data['price'] ?? null,
            'etsy_url' => $data['etsy_url'] ?? null
        ]);

        return [
            'success' => $success,
            'id' => $success ? $this->db->lastInsertId() : null
        ];
    }

    public function updateArtwork($id, $data) {
        if ($errors = $this->validate($data)) {
            if ($errors !== true) {
                return ['success' => false, 'errors' => $errors];
            }
        }

        $sql = "UPDATE {$this->table} 
                SET title = :title, 
                    class_name = :class_name, 
                    image_url = :image_url, 
                    description = :description, 
                    medium = :medium, 
                    dimensions = :dimensions, 
                    price = :price, 
                    etsy_url = :etsy_url 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $success = $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'class_name' => $data['class_name'] ?? null,
            'image_url' => $data['image_url'],
            'description' => $data['description'] ?? null,
            'medium' => $data['medium'] ?? null,
            'dimensions' => $data['dimensions'] ?? null,
            'price' => $data['price'] ?? null,
            'etsy_url' => $data['etsy_url'] ?? null
        ]);

        return ['success' => $success];
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