<?php

    namespace App\Models;
    use PDO;

    class Comments{

        private PDO $pdo;

        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        public function create(int $userId, int $postId, string $comment): bool{
            $sql = $this->pdo->prepare("INSERT INTO comments  (user_id, post_id, body) VALUES (:user_id, :post_id, :body)");
            $sql->bindValue(':user_id', $userId);
            $sql->bindValue(':post_id', $postId);
            $sql->bindValue(':body', $comment);

            return $sql->execute();
        }

        public function getComments(int $postId): array{
                $sql = $this->pdo->prepare("SELECT comments.*, users.name FROM comments JOIN users ON users.id = comments.user_id
                    WHERE comments.post_id = :post_id
                    ORDER BY comments.created_at DESC
                ");
            
                $sql->bindValue(':post_id', $postId);
                $sql->execute();
            
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    