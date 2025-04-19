<?php

namespace app\views;

class View {
    public function render($view, $data = []) {
        extract($data);
        require_once __DIR__ . "/../views/{$view}.php";
    }
} 