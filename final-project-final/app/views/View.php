<?php

namespace app\views;

class View {
    public function render($view, $data = []) {
        extract($data);
        
        // Try both .php and .html extensions
        $phpFile = __DIR__ . "/../views/{$view}.php";
        $htmlFile = __DIR__ . "/../views/{$view}.html";
        
        if (file_exists($phpFile)) {
            require_once $phpFile;
        } elseif (file_exists($htmlFile)) {
            require_once $htmlFile;
        } else {
            throw new \Exception("View file not found: {$view}");
        }
    }
} 