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
        $data = [
            'title' => 'Welcome to My Art Portfolio',
            'description' => 'Explore my collection of artworks and creative projects.'
        ];
        
        $this->view->render('main/homepage', $data);
    }

    public function notFound() {
    }

}