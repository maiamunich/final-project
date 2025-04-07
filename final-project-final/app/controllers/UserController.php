<?php

namespace app\controllers;
use app\models\User;

//this is an example controller class, feel free to delete
class UserController extends Controller {
    public function getUsers() {
        $userModel = new User();
        $users = $userModel->getAllUsers();
        $this->returnJSON($users);
    }

    public function usersView() {
        $this->returnView('./assets/views/users/usersView.html');
    }

}