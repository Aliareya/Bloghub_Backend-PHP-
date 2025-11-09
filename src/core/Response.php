<?php
namespace App\Core;

class Response{
    public function sendSuccessData($key,$data){
        http_response_code(200);
        echo json_encode([
            "status" => "success",
            $key => $data,
        ]);
    }


    public function success($message){
        http_response_code(200);
        echo json_encode([
            "status" => "success",
            "message" => $message,
        ]);
    }

    public function error($message , $code = 500){
        http_response_code($code);
        echo json_encode([
            "status" => "error",
            "message" => $message,
        ]);
    }

    public function jsonSend(array $data){
        http_response_code(200);
        echo json_encode($data);
    }


}
