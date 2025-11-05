<?php
namespace App\model;

use App\repositories\UserRepository;
class User{
    private string $name;
    private string $username;
    private string $role;
    private string $email;
    private string $password;
    private string $confirm_password;
    private UserRepository $userRepository;

    public function __construct( $data , $userRepository){
        $this->name = $data["name"];
        $this->username = $data["username"];
        $this->role = $data["role"];
        $this->email = $data["email"];
        $this->password = $data["password"];
        $this->confirm_password = $data["confirm_password"];
        $this->userRepository = $userRepository;
    }

    public function save(): bool{
       return $this->userRepository->store([
            "name"=> $this->name,
            "username"=> $this->username,
            "role"=> $this->role,
            "email"=> $this->email,
            "password"=> $this->password,
        ]);
    }
}