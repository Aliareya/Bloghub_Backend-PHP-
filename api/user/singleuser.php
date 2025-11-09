<?php
require_once "../../bootstrap/init.php";

use App\core\Requist;
use App\Core\Response;
use App\Core\Validator;
use App\repositories\UserRepository;

//require object 
$requist = new Requist();
$validator = new Validator();
$response = new Response();
$objUserRepository = new UserRepository();

//app logic
if ($requist->getMethod() === "POST") {
   $username = $requist->input("username");
   $user = $objUserRepository->getByusername($username);
   if(count($user) > 0) {
      http_response_code(200);
      echo json_encode([
         "status" => "success",
         "user" => $user,
      ]);
   } else {
    echo json_encode(["users"=>"no user"],400);
   }
}