<?php

use App\core\Requist;
use App\Core\Response;
use App\repositories\PostRepository;

require_once("../../bootstrap/init.php");

$requist = new Requist();
$response = new Response();
$postReposiory = new PostRepository();


if($requist->getMethod() == "POST"){
   $id = $requist->input("post_id");
   if($postReposiory->delete($id )){
       echo json_encode([
            "status"=> "success",
            "message"=> "Post delete Successfully.",
        ]);
   }else{
        echo json_encode([
            "status"=> "error",
            "data"=> "Feild to delete post",
        ]);
   }

}