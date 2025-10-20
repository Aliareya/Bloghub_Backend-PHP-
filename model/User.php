<?php
namespace app\model;

use app\repositories\UserRepository;


class User{
  private $name;
  private $username;
  private $email;
  private $password;
  private UserRepository $userRepository;

  public function __construct(array $data){ 
    $this->name = $data["name"];
    $this->username = $data['username'];
    $this->email = $data['email'];
    $this->password = $data['password'];
    $this->userRepository = new UserRepository();
  }

  public function save(){
        return $this->userRepository->store([
            "name" => $this->name,
            "username" => $this->username,
            "email" => $this->email,
            "password" => $this->password,
        ]);
    }

}