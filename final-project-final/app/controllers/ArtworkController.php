<?php

namespace app\controllers;

use app\models\Artwork;

class ArtworkController {
    private $artworkModel;

    public function __construct() {
        $this->artworkModel = new Artwork();
    }

    public function index() {
        $artworks = $this->artworkModel->getAllArtworks();
        include __DIR__ . '/../views/artworks/index.php';
    }

    public function show($id) {
        $artwork = $this->artworkModel->getArtworkById($id);
        if (!$artwork) {
            include __DIR__ . '/../views/404.php';
            return;
        }
        include __DIR__ . '/../views/artworks/show.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateArtworkData($_POST);
            if ($data) {
                $this->artworkModel->createArtwork($data);
                header('Location: /artworks');
                exit;
            }
        }
        include __DIR__ . '/../views/artworks/create.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateArtworkData($_POST);
            if ($data) {
                $this->artworkModel->updateArtwork($id, $data);
                header('Location: /artworks/' . $id);
                exit;
            }
        }
        $artwork = $this->artworkModel->getArtworkById($id);
        if (!$artwork) {
            include __DIR__ . '/../views/404.php';
            return;
        }
        include __DIR__ . '/../views/artworks/edit.php';
    }

    public function delete($id) {
        $this->artworkModel->deleteArtwork($id);
        header('Location: /artworks');
        exit;
    }

    public function getArtworksByYear($year) {
        $artworks = $this->artworkModel->getArtworksByYear($year);
        include __DIR__ . '/../views/artworks/year.php';
    }

    public function getArtworksByClass($class) {
        $artworks = $this->artworkModel->getArtworksByClass($class);
        include __DIR__ . '/../views/artworks/class.php';
    }

    private function validateArtworkData($data) {
        $required = ['title', 'year', 'image_url'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }

        // Sanitize and validate data
        return [
            'title' => htmlspecialchars($data['title']),
            'year' => (int)$data['year'],
            'class_name' => !empty($data['class_name']) ? htmlspecialchars($data['class_name']) : null,
            'image_url' => htmlspecialchars($data['image_url']),
            'description' => !empty($data['description']) ? htmlspecialchars($data['description']) : null,
            'medium' => !empty($data['medium']) ? htmlspecialchars($data['medium']) : null,
            'dimensions' => !empty($data['dimensions']) ? htmlspecialchars($data['dimensions']) : null,
            'price' => !empty($data['price']) ? (float)$data['price'] : null,
            'etsy_url' => !empty($data['etsy_url']) ? htmlspecialchars($data['etsy_url']) : null
        ];
    }
} 