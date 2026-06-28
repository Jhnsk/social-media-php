<?php

    namespace App\Repositories;

    use PDO;

    class UserRepository
    {
        public function __construct(private PDO $pdo){}

        public function findByEmail(string $email): array|false
        {
            $sql = $this->pdo->prepare("SELECT id, name, email, 
            password FROM users WHERE email = :email");

            $sql->bindValue(':email', $email);
            $sql->execute();

            return $sql->fetch(PDO::FETCH_ASSOC);
        }

        public function create(string $name,string $email,string $password): bool
        {

            $sql = $this->pdo->prepare("INSERT INTO users 
            (name, email, password) VALUES (:name, :email, :password)");

            $sql->bindValue(':name', $name);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':password', $password);

            return $sql->execute();
    }

}