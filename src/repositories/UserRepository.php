<?php
namespace App\repositories;
class UserRepository extends BaseRepository{
  protected string $tableName = "users";

  public function checkUserEmail($email){
    $user = $this->where("email",$email);
    return count($user) > 0;
  }

  public function checkUsername($username){
    $user = $this->where("username",$username);
    return count($user) > 0;
  }

  // public function getuserid($username){
  //   $user = $this->where("username",$username);
  //   return count($user) > 0? $user[0] : null;
  // }
  
}