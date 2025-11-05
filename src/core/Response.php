<?php
namespace App\Core;

class Response {

public function sendError(array $errors, int $status = 404): void {
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');

    $messages = [];

    // Flatten all error messages
    foreach ($errors as $field => $msgs) {
        if (is_array($msgs)) {
            foreach ($msgs as $msg) {
                $messages[$field] = $msg;
            }
        } else {
            $messages[] = $msgs;
        }
    }

    echo json_encode([
        'status' => 'error',
        'messages' => $messages
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}



    public function jsonSend(array $data, int $status = 200): void {
        http_response_code($status);                 
        header('Content-Type: application/json');   
        echo json_encode([
            'status'=> $status,
            'data'=> $data,
        ]);
        exit;                                       
    }

    public function textSend(string $content, int $status = 200): void {
        http_response_code($status);
        echo $content;
        exit;
    }

    public function redirect(string $url): void {
        header("Location: $url");
        exit;
    }

    public function download(string $filePath, ?string $name = null): void {
        if (!file_exists($filePath)) {
            http_response_code(404);
            echo "فایل پیدا نشد.";
            exit;
        }

        $name = $name ?? basename($filePath);
        header('Content-Description: File Transfer');
        header('Content-Type: ' . mime_content_type($filePath));
        header('Content-Disposition: attachment; filename="' . $name . '"');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }
}
