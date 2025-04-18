<?php

class ArtworksController {
    private $artworkModel;

    public function __construct() {
        $this->artworkModel = new ArtworkModel();
    }

    public function apiIndex() {
        $artworks = $this->artworkModel->getAllArtworks();
        $classes = $this->artworkModel->getAllClasses();
        
        $response = [
            'artworks' => $artworks,
            'classes' => $classes
        ];
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function apiGetArtwork($id) {
        $artwork = $this->artworkModel->getArtworkById($id);
        if ($artwork) {
            header('Content-Type: application/json');
            echo json_encode($artwork);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Artwork not found']);
        }
    }

    public function apiUpdateArtwork($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $this->artworkModel->updateArtwork($id, $data);
            
            if ($result) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Failed to update artwork']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
        }
    }

    public function apiCreateArtwork() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $this->artworkModel->createArtwork($data);
            
            if ($result) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'id' => $result]);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Failed to create artwork']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
        }
    }

    public function apiGetArtworksByClass($class) {
        $artworks = $this->artworkModel->getArtworksByClass($class);
        if ($artworks) {
            header('Content-Type: application/json');
            echo json_encode([
                'class' => $class,
                'artworks' => $artworks
            ]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'No artworks found for this class']);
        }
    }
} 