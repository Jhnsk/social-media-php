<?php

    namespace App\Repositories;

    use PDO;

    class LikeRepository 
    {
        public function __construct(private PDO $pdo){}

        public function toggle(int $userId, int $postId): bool 
        {
            $sql = $this->pdo->prepare("SELECT id FROM likes WHERE user_id = :user_id AND post_id = :post_id");
            $sql->bindValue(':user_id', $userId);
            $sql->bindValue(':post_id', $postId);
            $sql->execute();

            $like = $sql->fetch();
  
            if ($like) {
  
                $delete = $this->pdo->prepare("DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id");
                $delete->bindValue(':user_id', $userId);
                $delete->bindValue(':post_id', $postId);
                $delete->execute();

                return false;
            }
  
                $insert = $this->pdo->prepare("INSERT INTO likes (user_id, post_id) VALUES (:user_id, :post_id)");
                $insert->bindValue(':user_id', $userId);
                $insert->bindValue(':post_id', $postId);
                $insert->execute();
    
                return true;
        }

        public function getLikesCount(int $postId): int
        {
            $sql = $this->pdo->prepare("SELECT COUNT(*) as total FROM likes WHERE post_id = :post_id");
            $sql->bindValue(':post_id', $postId);
            $sql->execute();

            $result = $sql->fetch(PDO::FETCH_ASSOC);

            return $result['total'];
        }

        public function hasLiked(int $userId, int $postId): bool{

            $sql = $this->pdo->prepare("
                SELECT id 
                FROM likes 
                WHERE user_id = :user_id 
                AND post_id = :post_id
            ");
        
            $sql->bindValue(':user_id', $userId);
            $sql->bindValue(':post_id', $postId);
        
            $sql->execute();
        
            return $sql->rowCount() > 0;
        }
    }