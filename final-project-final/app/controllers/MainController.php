<?php

namespace app\controllers;

use app\core\Controller;

//this is an example controller class, feel free to delete
class MainController extends Controller {
    public function homepage() {
        $this->render('main/homepage');
    }

    public function notFound() {
        $this->render('404');
    }
}