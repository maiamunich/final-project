<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// First define the URI variables
$uri = $_SERVER["REQUEST_URI"] ?? '/';
$uri = strtok($uri, '?');
$uriArray = explode("/", $uri);

// Use dirname to get the correct path
$basePath = dirname(__DIR__);

// Update require paths
require_once $basePath . "/app/models/Model.php";
require_once $basePath . "/app/models/Artwork.php";
require_once $basePath . "/app/controllers/MainController.php";
require_once $basePath . "/app/controllers/ArtworkController.php";

use app\controllers\MainController;
use app\controllers\ArtworkController;

$routeMatched = false;

// Homepage route
if ($uri === '/') {
    $controller = new MainController();
    $controller->homepage();
    $routeMatched = true;
    exit();
}

// Artworks routes
if ($uri === '/artworks') {
    $controller = new ArtworkController();
    $controller->index();
    $routeMatched = true;
    exit();
}

if (preg_match('/^\/artworks\/(\d+)$/', $uri, $matches)) {
    $controller = new ArtworkController();
    $controller->show($matches[1]);
    $routeMatched = true;
    exit();
}

if (preg_match('/^\/artworks\/year\/(\d+)$/', $uri, $matches)) {
    $controller = new ArtworkController();
    $controller->byYear($matches[1]);
    $routeMatched = true;
    exit();
}

if (preg_match('/^\/artworks\/class\/([^\/]+)$/', $uri, $matches)) {
    $controller = new ArtworkController();
    $controller->byClass(urldecode($matches[1]));
    $routeMatched = true;
    exit();
}

// If no route matched, show 404
if (!$routeMatched) {
    http_response_code(404);
    include $basePath . "/public/assets/views/404.html";
    exit();
} 