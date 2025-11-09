<?php
namespace App\Core;

class FileUploader{

    public static function upload(array $file, string $uploadDir, array $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'], int $maxSize = 5242880): array
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'filename' => null, 'error' => 'File upload error.'];
        }

        if ($file['size'] > $maxSize) {
            return ['success' => false, 'filename' => null, 'error' => 'File is too large (max 5MB).'];
        }

        if (!in_array($file['type'], $allowedTypes)) {
            return ['success' => false, 'filename' => null, 'error' => 'Invalid file type.'];
        }

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = uniqid('file_', true) . '.' . strtolower($ext);
        $targetPath = rtrim($uploadDir, '/') . '/' . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return ['success' => true, 'filename' => $fileName, 'error' => null];
        }

        return ['success' => false, 'filename' => null, 'error' => 'Failed to move uploaded file.'];
    }
}
