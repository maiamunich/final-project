<?php

namespace app\controllers;

use app\models\Artwork;
use app\views\View;

class ArtworkController {
    private $artwork;
    private $view;

    public function __construct() {
        $this->artwork = new Artwork();
        $this->view = new View();
    }

    public function index() {
        $artworks = $this->artwork->all();
        $this->view->render('artworks/gallery', ['artworks' => $artworks]);
    }

    public function show($id) {
        $artwork = $this->artwork->find($id);
        if (!$artwork) {
            http_response_code(404);
            $this->view->render('errors/404');
            return;
        }
        $this->view->render('artworks/show', ['artwork' => $artwork]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateArtworkData($_POST);
            $result = $this->artwork->createArtwork($data);
            
            if ($result['success']) {
                header('Location: /artworks/' . $result['id']);
                exit;
            } else {
                $this->view->render('artworks/create', [
                    'errors' => $result['errors'],
                    'old' => $_POST
                ]);
                return;
            }
        }
        $this->view->render('artworks/create');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validateArtworkData($_POST);
            $result = $this->artwork->updateArtwork($id, $data);
            
            if ($result['success']) {
                header('Location: /artworks/' . $id);
                exit;
            } else {
                $this->view->render('artworks/edit', [
                    'errors' => $result['errors'],
                    'artwork' => array_merge(['id' => $id], $_POST)
                ]);
                return;
            }
        }
        
        $artwork = $this->artwork->find($id);
        if (!$artwork) {
            http_response_code(404);
            $this->view->render('errors/404');
            return;
        }
        
        $this->view->render('artworks/edit', ['artwork' => $artwork]);
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $success = $this->artwork->delete($id);
            if ($success) {
                header('Location: /artworks');
                exit;
            } else {
                http_response_code(500);
                $this->view->render('errors/500');
                return;
            }
        }
        http_response_code(405);
        $this->view->render('errors/405');
    }

    public function getArtworksByClass($class) {
        $artworks = $this->artwork->getByClass($class);
        $this->view->render('artworks/class', [
            'class' => $class,
            'artworks' => $artworks
        ]);
    }

    public function gallery() {
        $artworks = $this->artwork->all();
        $classes = $this->artwork->getUniqueClasses();
        
        $this->view->render('artworks/gallery', [
            'classes' => $classes,
            'artworks' => $artworks
        ]);
    }

    public function byClass($class) {
        $artworks = $this->artwork->getByClass($class);
        $this->view->render('artworks/gallery', [
            'artworks' => $artworks,
            'currentClass' => $class
        ]);
    }

    public function getArtworksApi() {
        header('Content-Type: application/json');
        try {
            error_log("getArtworksApi called");
            
            error_log("Fetching all artworks...");
            $artworks = $this->artwork->all();
            error_log("Artworks fetched: " . print_r($artworks, true));
            
            error_log("Fetching unique classes...");
            $classes = $this->artwork->getUniqueClasses();
            error_log("Classes fetched: " . print_r($classes, true));

            $response = [
                'success' => true,
                'data' => [
                    'artworks' => $artworks,
                    'classes' => $classes
                ]
            ];
            error_log("Sending response: " . json_encode($response));
            echo json_encode($response);
        } catch (\Exception $e) {
            error_log("Error in getArtworksApi: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'Failed to fetch artworks: ' . $e->getMessage()
            ]);
        }
    }

    public function getArtworkApi($id) {
        header('Content-Type: application/json');
        try {
            $artwork = $this->artwork->find($id);
            if (!$artwork) {
                http_response_code(404);
                echo json_encode([
                    'success' => false,
                    'error' => 'Artwork not found'
                ]);
                return;
            }

            echo json_encode([
                'success' => true,
                'data' => $artwork
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'Failed to fetch artwork: ' . $e->getMessage()
            ]);
        }
    }

    private function validateArtworkData($data) {
        $required = ['title', 'image_url'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }

        return [
            'title' => htmlspecialchars($data['title']),
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