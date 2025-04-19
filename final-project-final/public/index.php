<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load environment variables from .env file
$basePath = dirname(__DIR__);
$envFile = $basePath . '/.env';

error_log("Starting application...");
error_log("Base path: " . $basePath);
error_log("Env file path: " . $envFile);

if (file_exists($envFile)) {
    error_log(".env file found");
    $envContents = file_get_contents($envFile);
    error_log("Env file contents: " . $envContents);
    
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            $_ENV[$key] = $value;
            putenv("$key=$value");
            error_log("Set environment variable: $key = $value");
        }
    }
    
    // Debug output - check all required DB variables
    $required_vars = ['DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_SOCKET'];
    foreach ($required_vars as $var) {
        error_log("$var = " . (isset($_ENV[$var]) ? $_ENV[$var] : 'NOT SET'));
    }
} else {
    error_log("ERROR: .env file not found at: " . $envFile);
    die("Configuration Error: .env file not found. Please check the application configuration.");
}

// First define the URI variables
$uri = $_SERVER["REQUEST_URI"] ?? '/';
$uri = strtok($uri, '?');
$uriArray = explode("/", $uri);

// Use dirname to get the correct path
$basePath = dirname(__DIR__);

// Update require paths
require_once $basePath . "/app/core/Controller.php";
require_once $basePath . "/app/models/Model.php";
require_once $basePath . "/app/models/Artwork.php";
require_once $basePath . "/app/models/Commission.php";
require_once $basePath . "/app/views/View.php";
require_once $basePath . "/app/controllers/MainController.php";
require_once $basePath . "/app/controllers/ArtworkController.php";
require_once $basePath . "/app/controllers/ContactController.php";

use app\controllers\MainController;
use app\controllers\ArtworkController;
use app\controllers\ContactController;

$routeMatched = false;

// Homepage route
if ($uri === '/') {
    $controller = new MainController();
    $controller->homepage();
    $routeMatched = true;
    exit();
}

// Contact route
if ($uri === '/contact') {
    $controller = new ContactController();
    $controller->index();
    $routeMatched = true;
    exit();
}

// API routes
if ($uri === '/api/commission' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ContactController();
    $controller->submit();
    $routeMatched = true;
    exit();
}

if ($uri === '/api/artworks' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new ArtworkController();
    $controller->getArtworksApi();
    $routeMatched = true;
    exit();
}

// Add route for fetching a single artwork via API
if (preg_match('/^\/api\/artworks\/(\d+)$/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new ArtworkController();
    $controller->getArtworkApi($matches[1]);
    $routeMatched = true;
    exit();
}

// Add route for UPDATING a single artwork via API (used by edit.php)
if (preg_match('/^\/api\/artworks\/update\/(\d+)$/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ArtworkController();
    $controller->updateArtworkApi($matches[1]); // Pass ID 
    $routeMatched = true;
    exit();
}

// Add route for fetching artworks BY CLASS via API (used by class.php)
if (preg_match('/^\/api\/artworks\/class\/([^\/]+)$/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new ArtworkController();
    $controller->getArtworksByClassApi(urldecode($matches[1])); // Pass decoded class name
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
    include $basePath . '/app/views/404.php';
    exit();
} 