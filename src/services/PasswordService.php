<?php
namespace App\services;

class PasswordService{

    public function hashPassword($password){
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $password;
    }

}
