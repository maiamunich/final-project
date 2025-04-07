<?php

namespace app\models;

//this is an example model class, feel free to delete
class User extends Model {

    protected $table = 'users';

    public function getAllUsers() {
        return $this->findAll();
    }
}