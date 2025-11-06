<?php
require_once "../../bootstrap/init.php";

use App\core\Requist;
use App\Core\Response;
use App\Core\Validator;
use App\model\User;
use App\repositories\UserRepository;

//require object 
$requist = new Requist();
$validator = new Validator();
$response = new Response();
$objUserRepository = new UserRepository();

//app logic
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = $requist->json();
    $data = $requist->sanitize($data);
    if ($validator->validate($data)) {
        $user = new User($data, $objUserRepository);
        if ($user->save()) {
            echo json_encode([
                "status" => "success",
                "message" => "Signup Successfully.",
            ]);
        } else {
            $response->textSend("error", 400);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => $validator->errors(),
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "",
    ]);
}