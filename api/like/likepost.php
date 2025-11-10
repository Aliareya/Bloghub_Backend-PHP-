<?php

use App\core\Requist;
use App\Core\Response;
use App\model\LikePost;
use App\repositories\LikeRepository;
require_once("../../bootstrap/init.php");
$requist = new Requist();
$response = new Response();
$objLikeRepository = new LikeRepository();

if($requist->getMethod() == "POST"){
    $data = $requist->json();
    $like = new LikePost($data , $objLikeRepository);

    if($like->save()){
        echo json_encode([
        "status" => "success",
        "message"=> "Post Like Successfully.",
        "data"=> $data
        ]);
    }else{
        echo json_encode([
            "status"=> "error",
            "message"=> "Feild To like Post."
        ]);
    }
    
}