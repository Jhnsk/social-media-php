<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{
    public function __construct(
        private PostRepository $postRepository
    ) {}

    public function create(string $body, ?array $image, int $userId): bool 
    {
        $body = trim($body);

        $imageError = $image['error'] ?? UPLOAD_ERR_NO_FILE;

        if (!$body && $imageError !== UPLOAD_ERR_OK) {
            return false;
        }

        $imageName = null;

        if ($imageError === UPLOAD_ERR_OK) {

            $extension = strtolower(
                pathinfo(
                    $image['name'],
                    PATHINFO_EXTENSION
                )
            );

            $allowedExtensions = ['jpg', 'jpeg', 'png'];

            if (!in_array($extension, $allowedExtensions)) {
                return false;
            }

            $imageName = bin2hex(random_bytes(16)) . '.' . $extension;

            $uploadPath = __DIR__ .
                '/../../Public/media/uploads/' .
                $imageName;

            if (!move_uploaded_file(
                $image['tmp_name'],
                $uploadPath
            )) {
                return false;
            }
        }

        return $this->postRepository->insertPost(
            $body,
            $imageName,
            $userId
        );
    }

    public function getPosts(int $userId): array
    {
        $result = $this->postRepository->getPosts($userId);
        return $result;
    }

    public function getUserPosts(int $userId): array
    {
        $result = $this->postRepository->getUserPosts($userId);
        return $result;
    }
}