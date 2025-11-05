<?php

use App\repositories\UserRepository;
use App\storagType\Mysql;
require_once("../../bootstrap/init.php");

use App\core\Requist;
use App\Core\Response;
use App\Core\Validator;
use App\model\User;

//require object 
$requist = new Requist();
$validator = new Validator();
$response = new Response();
$connection = new Mysql();
$objUserRepository = new UserRepository();

//app logic
if ($requist->getMethod() === "post") {
    $data = $requist->json();
    $data = $requist->sanitize($data);
    if ($validator->validate($data)) {
        $user = new User($data);
        var_dump($user);
    } else {
        echo "ali";
    }
}