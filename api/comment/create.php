<?php

use App\core\Requist;
use App\Core\Response;
use App\model\Comment;
use App\repositories\CommentRepository;
require_once("../../bootstrap/init.php");

$requist = new Requist();
$response = new Response();
$objcommentRepo = new CommentRepository();

if ($requist->getMethod() == "POST") {
    $data = $requist->json();
    $comment = new Comment($data, $objcommentRepo);
    $checkuser = $objcommentRepo->getcommentdata( $data["user_id"] , $data["post_id"]);
    if (empty($checkuser)) {
        if ($comment->save()) {
            echo json_encode([
                "status" => "success",
                "message" => "Comment Save Succeessfully.",
                "data" => $data
            ]);
        } else {
            echo json_encode([
                "status" => "errors",
                "message" => "Feild to save comments"
            ]);
        }
    }else{
        echo json_encode([
            "status" => "errors",
            "message" => "You can write just one commet"
        ]);
    }


}