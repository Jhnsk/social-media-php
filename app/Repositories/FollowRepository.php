<?php

    namespace App\Repositories;

    use PDO;

    class FollowRepository
    {
        public function __construct(private PDO $pdo){}

        public function insertFollow(int $follower, int $following ): bool{
            $sql = $this->pdo->prepare("INSERT INTO followers (follower_id, following_id) VALUES (:follower, :following)");
            $sql->bindValue(':follower', $follower);
            $sql->bindValue(':following', $following);

            return $sql->execute();
        }
    }