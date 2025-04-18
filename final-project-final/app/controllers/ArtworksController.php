<?php

class ArtworksController {
    private $artworkModel;

    public function __construct() {
        $this->artworkModel = new ArtworkModel();
    }

    public function apiIndex() {
        try {
            $artworks = $this->artworkModel->getAll();
            $classes = $this->artworkModel->getUniqueClasses();
            
            $response = [
                'success' => true,
                'data' => [
                    'artworks' => $artworks,
                    'classes' => $classes
                ]
            ];
            
            header('Content-Type: application/json');
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'Failed to fetch artworks: ' . $e->getMessage()
            ]);
        }
    }

    public function apiGetArtwork($id) {
        try {
            $artwork = $this->artworkModel->find($id);
            if ($artwork) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'data' => $artwork
                ]);
            } else {
                http_response_code(404);
                echo json_encode([
                    'success' => false,
                    'error' => 'Artwork not found'
                ]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'Failed to fetch artwork: ' . $e->getMessage()
            ]);
        }
    }

    public function apiUpdateArtwork($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = json_decode(file_get_contents('php://input'), true);
                $result = $this->artworkModel->update($id, $data);
                
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'data' => $result
                ]);
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'error' => 'Failed to update artwork: ' . $e->getMessage()
                ]);
            }
        } else {
            http_response_code(405);
            echo json_encode([
                'success' => false,
                'error' => 'Method not allowed'
            ]);
        }
    }

    public function apiCreateArtwork() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = json_decode(file_get_contents('php://input'), true);
                $result = $this->artworkModel->create($data);
                
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'data' => [
                        'id' => $result
                    ]
                ]);
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'error' => 'Failed to create artwork: ' . $e->getMessage()
                ]);
            }
        } else {
            http_response_code(405);
            echo json_encode([
                'success' => false,
                'error' => 'Method not allowed'
            ]);
        }
    }

    public function apiGetArtworksByClass($class) {
        try {
            $artworks = $this->artworkModel->getByClass($class);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'data' => [
                    'class' => $class,
                    'artworks' => $artworks
                ]
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'Failed to fetch artworks by class: ' . $e->getMessage()
            ]);
        }
    }
} 