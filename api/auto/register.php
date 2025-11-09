<?php
require_once "../../bootstrap/init.php";

use App\core\Requist;
use App\Core\Response;
use App\Core\Validator;
use App\model\User;
use App\repositories\UserRepository;
use App\services\PasswordService;


//require object 
$requist = new Requist();
$validator = new Validator();
$response = new Response();
$objUserRepository = new UserRepository();
$passwordservice = new PasswordService();


//app logic
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = $requist->json();
    $data = $requist->sanitize($data);
    if ($validator->validate($data)) {
        if (
            $objUserRepository->checkUserEmail($data["email"]) ||
            $objUserRepository->checkUsername($data["username"])) {
            if ($objUserRepository->checkUsername($data["username"])) {
                $response->error("This Username is Teken.");
            } else {
                $response->error("Email is Already Exist.");
            }

        } else {
            
            $data["password"] = $passwordservice->hashPassword($data["password"]);
            $user = new User($data, $objUserRepository);
            if ($user->save()) {
                $response->success("Register Successfully.");
            } else {
                $response->error("Feild To save user", 400);
            }
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => $validator->errors(),
        ]);
    }
} else {
    $response->error("Bad Requist Method" , 200);
}