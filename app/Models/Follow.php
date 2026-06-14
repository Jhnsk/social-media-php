<?php

    namespace App\Models;
    use PDO;

    class Follow{

        private PDO $pdo;

        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        public function getSuggestions(int $userId): array {

            $sql = $this->pdo->prepare("
                SELECT *
                FROM users
                WHERE id != :userId
        
                AND id NOT IN (
        
                    SELECT following_id
                    FROM followers
                    WHERE follower_id = :userId
        
                )
        
                LIMIT 5
            ");
        
            $sql->bindValue(':userId', $userId);
        
            $sql->execute();
        
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function following(int $follower, int $following ): bool{
            $sql = $this->pdo->prepare("INSERT INTO followers (follower_id, following_id) VALUES (:follower, :following)");
            $sql->bindValue(':follower', $follower);
            $sql->bindValue(':following', $following);

            return $sql->execute();
        }

        public function getFollowers(int $userId): array{

            $sql = $this->pdo->prepare("
            
                SELECT users.*
                FROM followers
                
                JOIN users
                ON users.id = followers.follower_id
                
                WHERE followers.following_id = :user_id
            
                
            ");
        
            $sql->bindValue(':user_id', $userId);
            $sql->execute();
        
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getFollowing(int $userId): array{
            $sql = $this->pdo->prepare("
            
                SELECT users.*
                FROM followers
                
                JOIN users
                ON users.id = followers.following_id
                
                WHERE followers.follower_id = :user_id
            
            ");
        
            $sql->bindValue(':user_id', $userId);
            $sql->execute();
        
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        
    }