<?php

    namespace App\Models;
    use PDO;

    class Post{

        private PDO $pdo;

        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
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