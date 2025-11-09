<?php
namespace App\model;

use App\repositories\PostRepository;

class Post{
    private ?int $id=null;
    private string $title;
    private string $content;
    private string $tage;
    private int $author;
    private string $category;
    private string $cover_image;

    private PostRepository $postRepository;


    public function __construct(array $data , $postRepo){ 
        // $this->id=$id;
        $this->title=$data["title"];
        $this->content=$data["content"];
        $this->tage=$data["tage"];
        $this->author=$data["author_id"];
        $this->cover_image=$data["cover_image"];
        $this->category=$data["category_id"];
        $this->postRepository=$postRepo;
    }

    public function save(){
        return $this->postRepository->store([
            "user_id"=>$this->author,
            "title"=> $this->title,
            "content"=> $this->content,
            "coverImage" => $this->cover_image,
            "category"=> $this->category,
            "tags"=> $this->tage
        ]);

    }







}