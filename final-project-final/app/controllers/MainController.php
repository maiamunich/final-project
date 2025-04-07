<?php

namespace app\controllers;

//this is an example controller class, feel free to delete
class MainController {

    public function homepage() {
        include __DIR__ . '/../views/main/homepage.php';
    }

    public function notFound() {
    }

}