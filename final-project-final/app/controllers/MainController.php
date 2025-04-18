<?php

namespace app\controllers;

use app\views\View;

//this is an example controller class, feel free to delete
class MainController {
    private $view;

    public function __construct() {
        $this->view = new View();
    }

    public function homepage() {
        require_once __DIR__ . '/../views/main/homepage.php';
    }

    public function notFound() {
        require_once __DIR__ . '/../views/404.php';
    }

}