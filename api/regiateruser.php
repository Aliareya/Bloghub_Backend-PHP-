<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

use app\core\Database;
use app\model\User;

spl_autoload_register(function ($class) {
  $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
  $path = str_replace('app\\', "", $class);
  // var_dump ($path);
  require_once('../'. $path .'.php');

});

$conn = Database::connection();
if($conn){
  $user = new User(1,"areyaFC" , "ali@gmail.com" , "123456");
  var_dump($user);
}




