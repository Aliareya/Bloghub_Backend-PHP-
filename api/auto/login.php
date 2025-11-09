<?php

use App\core\Requist;
use App\Core\Response;
use App\Core\Validator;
use App\repositories\UserRepository;
require_once "../../bootstrap/init.php";

$requist = new Requist();
$response = new Response();
$validator = new Validator();
$objUserRepository = new UserRepository();

if($_SERVER['REQUEST_METHOD']=== "POST"){
    $data = $requist->json();
    $data = $requist->sanitize($data);

    if($validator->loginVlidate($data)){
        $userPassword = $objUserRepository->PasswordCheck($data["username"] , $data["password"]);
        $usernameExist = $objUserRepository->checkUsername($data["username"]);

        if (!$usernameExist) {
            $response->error("Invalide Username");
        }else{
            $user = $objUserRepository->getByusername($data["username"]);
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "message" => "Login Successfully.",
                "data" => $user,
                "token" => "My token"
            ]);
        }
    } else {
        $response->error($validator->errors());
    }
    
}