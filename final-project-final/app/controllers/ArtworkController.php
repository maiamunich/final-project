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
        if ($artwork) {
            $this->view->render('artworks/show', ['artwork' => $artwork]);
        } else {
            $this->view->render('404');
        }
    }

    public function create() {
        $this->view->render('artworks/create');
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

    public function byClass($className) {
        $this->view->render('artworks/class');
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
} 