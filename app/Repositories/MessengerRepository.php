<?php

    namespace App\Repositories;

    use PDO;

    class MessengerRepository
    {
        public function __construct(private PDO $pdo){}

        public function createMsg(int $senderId, int $receiverId, string $msgText): bool{
            $sql = $this->pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (:sender_id, :receiver_id, :message)");
            $sql->bindValue(':sender_id', $senderId);
            $sql->bindValue(':receiver_id', $receiverId);
            $sql->bindValue(':message', $msgText);
            
            return $sql->execute();
        }

        public function getMessages(int $userId, int $receiverId): array
        {
            $sql = $this->pdo->prepare("
            
            SELECT 
                messages.*,
                users.name
            FROM messages
            JOIN users ON users.id = messages.sender_id
            WHERE 
                (
                    sender_id = :userId 
                    AND receiver_id = :receiverId
                )
                OR
                (
                    sender_id = :receiverId
                    AND receiver_id = :userId
                )
            ORDER BY created_at ASC
        
        ");
    
            $sql->bindValue(':userId', $userId);
            $sql->bindValue(':receiverId', $receiverId);
        
            $sql->execute();
        
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getLastMessage(int $userId, int $otherUserId): ?array
        {
            $sql = $this->pdo->prepare("
                SELECT *
                FROM messages
                WHERE
                    (sender_id = :user_id AND receiver_id = :other_user_id)
                    OR
                    (sender_id = :other_user_id AND receiver_id = :user_id)
                ORDER BY created_at DESC
                LIMIT 1
            ");

            $sql->bindValue(':user_id', $userId);
            $sql->bindValue(':other_user_id', $otherUserId);

            $sql->execute();

            return $sql->fetch(PDO::FETCH_ASSOC) ?: null;
        }
    }