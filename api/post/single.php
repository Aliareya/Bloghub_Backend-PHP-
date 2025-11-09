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
   $posts = $postReposiory->getsinglePost($id );
   echo json_encode([
        "status"=> "success",
        "data"=> $posts,
    ]);
}