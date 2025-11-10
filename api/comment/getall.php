<?php

use App\core\Requist;
use App\Core\Response;
use App\repositories\CommentRepository;
require_once("../../bootstrap/init.php");

$requist = new Requist();
$response = new Response();
$objcommentRepo = new CommentRepository();

if($requist->getMethod() == "POST"){
    $data = $requist->json();
    $post_id = $data["post_id"];
    $comment = $objcommentRepo->getByusername($post_id , "post_id");
    echo json_encode([
        "status" => "success",
        "data"=> $comment ,
    ]);

}