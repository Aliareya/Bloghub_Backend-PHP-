<?php
namespace App\model;

use App\repositories\LikeRepository;

class LikePost{
    private int $user_id;
    private int $post_id;
    private LikeRepository $likeRepository;

    public function __construct($data, $likeRepository){
       $this->user_id = $data['user_id'];
       $this->post_id = $data['post_id'];
       $this->likeRepository = $likeRepository;
    }

    public function save(){
       return $this->likeRepository->store([
        "user_id"=> $this->user_id,
        "post_id"=> $this->post_id
       ]);
    }


}