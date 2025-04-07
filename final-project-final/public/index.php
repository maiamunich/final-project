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

//set env variables
$env = parse_ini_file('../.env');
define('DBNAME', $env['DBNAME']);
define('DBHOST', $env['DBHOST']);
define('DBUSER', $env['DBUSER']);
define('DBPASS', $env['DBPASS']);

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
    $controller->getArtworksByYear($matches[1]);
    $routeMatched = true;
    exit();
}

if (preg_match('/^\/artworks\/class\/(.+)$/', $uri, $matches)) {
    $controller = new ArtworkController();
    $controller->getArtworksByClass(urldecode($matches[1]));
    $routeMatched = true;
    exit();
}

// Only show 404 if no routes matched
if (!$routeMatched) {
    include __DIR__ . '/assets/views/404.php';
    exit();
} 