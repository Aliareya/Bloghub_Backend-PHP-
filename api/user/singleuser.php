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
if ($requist->getMethod() === "get") {
   $users = $objUserRepository->getByware(7);

   if(count($users) > 0) {
    $response->jsonSend($users , 200);
   } else {
    $response->sendError(["users"=>"no user"],400);
   }
}