<?php

namespace app\controllers;

//this is an example controller class, feel free to delete
class MainController extends Controller {

    public function homepage() {
        //remember to route relative to index.php
        //require page and exit to return an HTML page
        $this->returnView('./assets/views/main/homepage.html');
    }

    public function notFound() {
    }

}