<?php
namespace App\Core;

class Response {

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
