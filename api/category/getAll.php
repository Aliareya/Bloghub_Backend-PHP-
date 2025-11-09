<?php
use App\core\Requist;
use App\Core\Response;
use App\Core\Validator;
use App\repositories\CategoryRepository;

require_once "../../bootstrap/init.php" ;

$requist = new Requist();
$response = new Response();
$validator = new Validator();
$objCategoryRepo = new CategoryRepository();

if($requist->getMethod() === "GET"){
    $categories = $objCategoryRepo->getAll();
    $response->jsonSend([
        "status"=> "success",
        "category"=> $categories
    ]);
}