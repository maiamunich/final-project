<?php

namespace app\core;

use app\controllers\MainController;
use app\controllers\UserController;
use app\controllers\ContactController;
use app\controllers\ArtworkController;

class Router {
    public $uriArray;

    function __construct() {
        $this->uriArray = $this->routeSplit();
        $this->handleRoutes();
    }

    protected function routeSplit() {
        $removeQueryParams = strtok($_SERVER["REQUEST_URI"], '?');
        return explode("/", $removeQueryParams);
    }

    protected function handleRoutes() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $this->uriArray[1] ?? '';
        $id = $this->uriArray[2] ?? null;
        $api = $path === 'api';
        $apiPath = $this->uriArray[2] ?? '';
        $apiId = $this->uriArray[3] ?? null;

        // Handle API routes
        if ($api) {
            $this->handleApiRoutes($apiPath, $apiId, $method);
            return;
        }

        // Handle main routes
        if ($path === '' && $method === 'GET') {
            $mainController = new MainController();
            $mainController->homepage();
            return;
        }

        // Handle artwork routes
        if ($path === 'artworks') {
            $artworkController = new ArtworkController();
            
            if ($id === null) {
                // GET /artworks - List all artworks
                if ($method === 'GET') {
                    $artworkController->gallery();
                }
                // POST /artworks - Create new artwork
                else if ($method === 'POST') {
                    $artworkController->create();
                }
            } else {
                // GET /artworks/{id} - Show single artwork
                if ($method === 'GET') {
                    $artworkController->show($id);
                }
                // PUT /artworks/{id} - Update artwork
                else if ($method === 'PUT') {
                    $artworkController->update($id);
                }
                // DELETE /artworks/{id} - Delete artwork
                else if ($method === 'DELETE') {
                    $artworkController->delete($id);
                }
            }
            return;
        }

        // Handle user routes
        if ($path === 'users' && $method === 'GET') {
            $userController = new UserController();
            $userController->usersView();
            return;
        }

        // Handle contact routes
        if ($path === 'contact') {
            $contactController = new ContactController();
            if ($method === 'GET') {
                $contactController->contactView();
            }
            return;
        }

        // Handle 404 for unknown routes
        http_response_code(404);
        $view = new View();
        $view->render('errors/404');
    }

    protected function handleApiRoutes($path, $id, $method) {
        switch ($path) {
            case 'artworks':
                $artworkController = new ArtworkController();
                if ($id === null) {
                    // GET /api/artworks - Get all artworks
                    if ($method === 'GET') {
                        $artworkController->getArtworksApi();
                    }
                } else {
                    // GET /api/artworks/{id} - Get single artwork
                    if ($method === 'GET') {
                        $artworkController->getArtworkApi($id);
                    }
                }
                break;

            case 'users':
                $userController = new UserController();
                if ($method === 'GET') {
                    $userController->getUsers();
                }
                break;

            case 'commission':
                $contactController = new ContactController();
                if ($method === 'POST') {
                    $contactController->handleCommission();
                }
                break;

            default:
                http_response_code(404);
                echo json_encode(['error' => 'Not Found']);
                break;
        }
    }
}