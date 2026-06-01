<?php

class Post{

    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function create(string $body, array $image, int $userId): bool{

        if(!$body && $image['error'] !== UPLOAD_ERR_OK){
            return false;
        }

        $imageName = null;

        if($image['error'] === UPLOAD_ERR_OK){

            $extension = strtolower(
                pathinfo(
                    $image['name'],
                    PATHINFO_EXTENSION
                )
            );

            $allowed = ['jpg', 'jpeg', 'png'];

            if(!in_array($extension, $allowed)){
                return false;
            }

            $imageName = bin2hex(random_bytes(16)) . '.' . $extension;

            move_uploaded_file(
                $image['tmp_name'],
                __DIR__ . '/../../public/media/uploads/' . $imageName
            );

        }

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

    public function getUserPosts(int $userId): array{

        $sql = $this->pdo->prepare("
        
            SELECT *
            FROM posts
            WHERE user_id = :user_id
            ORDER BY created_at DESC
        
        ");
    
        $sql->bindValue(':user_id', $userId);
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}