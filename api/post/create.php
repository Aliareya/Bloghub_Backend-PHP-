<?php

use App\Core\FileUploader;
use App\Core\Requist;
use App\Core\Response;
use App\Core\Validator;
use App\model\Post;
use App\repositories\PostRepository;
use App\repositories\UserRepository;


require_once("../../bootstrap/init.php");

$requist = new Requist();
$response = new Response();
$validator = new Validator();
$postRepository = new PostRepository();
$userRepository = new UserRepository();



if ($requist->getMethod() === "POST") {

    $data = $requist->postdata();

    if (!$validator->validatePost($data)) {
        $response->error($validator->errors()[0]);
        exit;
    }

    $file = $_FILES["coverImage"] ?? null;
    $uploadDir = "../../public/images";

    if (!$file) {
        $response->error("Cover image is required.", 200);
        exit;
    }

    $upload = FileUploader::upload($file, $uploadDir);

    if (!$upload['success']) {
        $response->error($upload['error'], 200);
        exit;
    }

    $data['cover_image'] = $upload['filename'];
    $userid = $userRepository->getByusername($data['username']);


    $insertData = [
        'title'       => $data['title'],
        'tage'        => $data['tage'],
        'content'     => $data['content'],
        'category_id' => $data['category_id'],
        'author_id'   =>  $userid[0]["id"], 
        'cover_image' => $data['cover_image'],
        'created_at'  => date("Y-m-d H:i:s"),
        'updated_at'  => date("Y-m-d H:i:s")
    ];
        
    $post = new Post($insertData , $postRepository);

    if ($post->save()) {
        $response->success("Post created successfully!");
    } else {
        echo json_encode([
            "status" =>"errors",
            "message"=> "reeeoe",
        ]);
    }

} else {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Method Not Allowed"
    ]);
}
