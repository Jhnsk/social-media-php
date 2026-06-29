<?php

namespace App\Repositories;

use PDO;

class PostRepository
{
    public function __construct(private PDO $pdo) {}

    public function insertPost(string $body, ?string $imageName, int $userId): bool 
    {
        $sql = $this->pdo->prepare("
            INSERT INTO posts (body, image, user_id)
            VALUES (:body, :image, :user_id)
        ");

        $sql->bindValue(':body', $body);
        $sql->bindValue(':image', $imageName);
        $sql->bindValue(':user_id', $userId);

        return $sql->execute();
    }
}