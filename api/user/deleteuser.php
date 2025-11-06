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
if ($requist->getMethod() === "delete") {
   $users = $objUserRepository->delete(7);

   if($users) {
    $response->textSend("success" , 200);
   } else {
    $response->sendError(["users"=>"no user"],400);
   }
}