<?php

namespace app\core;

class Controller {
    protected function render($view, $data = []) {
        extract($data);
        // Check if .html version exists first
        $viewPath = __DIR__ . "/../views/{$view}";
        if (file_exists($viewPath . '.html')) {
            require_once $viewPath . '.html';
        } else if (file_exists($viewPath . '.php')) {
            require_once $viewPath . '.php';
        } else {
            throw new \Exception("View file not found: {$view}");
        }
    }

    protected function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
} 