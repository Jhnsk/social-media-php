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

    public function getPosts(int $userId): array {

        $sql = $this->pdo->prepare("
        SELECT 
                posts.*,
                users.name,
                users.email

            FROM posts

            INNER JOIN users
                ON posts.user_id = users.id

            WHERE posts.user_id = :userId

            OR posts.user_id IN (

                SELECT following_id
                FROM followers
                WHERE follower_id = :userId

            )

            ORDER BY posts.created_at DESC
        ");
    
        $sql->bindValue(':userId', $userId);
    
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}