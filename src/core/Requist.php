<?php
namespace App\core;
class Requist
{
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $pos = strpos($path, '?');
        if ($pos !== false) {
            $path = substr($path, 0, $pos);
        }
        return $path;
    }

    public function all(): array
    {
        $data = json_decode(file_get_contents('php://input'), true);
        return $data;
    }

    public function input(string $key)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data[$key])) {
            $input = $data[$key];
            $input = htmlspecialchars(trim($input));
            return $input;
        } else {
            return 'Invalide Key';
        }
    }

    public function json(): array
    {
        $data = json_decode(file_get_contents('php://input'), true);
        return $data ?: [];
    }

    public function sanitize(array $data): array
    {
        $clean = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        return array_map(function ($value) {
            return is_string($value) ? trim($value) : $value;
        }, $clean);
    }

    public function file(string $key): ?array{
        if (isset($_FILES[$key])) {
            return $_FILES[$key]; 
        }
        return null;
    }




}