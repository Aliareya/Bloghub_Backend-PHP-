<?php
namespace app\model;

use app\repositories\UserRepository;


class User{
  public $id;
  public $username;
  public $email;
  public $password;
  private UserRepository $userRepository;

  public function __construct($id,$username,$email,$password){ 
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->userRepository = new UserRepository();
  }

  public function save(){
        return $this->userRepository->store([
            "id" => $this->id,
            "description" => $this->username,
            "email" => $this->email,
            "password" => $this->password,
        ]);
    }

}