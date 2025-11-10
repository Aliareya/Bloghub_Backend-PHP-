<?php
namespace App\model;

use App\repositories\CommentRepository;

class Comment{
    private $user_id;
    private $post_id;
    private $authorName;
    private $authorEmail;
    private $content;

    private CommentRepository $commentRepo;

    public function __construct($data , $commentRepo){
        $this->user_id = $data["user_id"];
        $this->post_id = $data["post_id"];
        $this->authorName = $data["authorname"];
        $this->authorEmail = $data["authoremail"];
        $this->content = $data["content"];
        $this->commentRepo = $commentRepo;
    }

    public function save(){
        return $this->commentRepo->store([
            "user_id"=> $this->user_id,
            "post_id"=> $this->post_id,
            "author_name"=> $this->authorName,
            "author_email"=> $this->authorEmail,
            "content"=> $this->content
        ]);
    }

}