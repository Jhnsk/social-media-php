<?php

    namespace App\Models;
    use PDO;

    class User{

        private PDO $pdo;

        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        private function findByEmail(string $email){
            $sql = $this->pdo->prepare("SELECT id, name, email, password FROM users WHERE email = :email");
            $sql->bindValue(':email', $email);
            $sql->execute();

            return $sql->fetch(PDO::FETCH_ASSOC);
        }


       

        public function login(string $email,string $password): array|bool{
           
            $user = $this->findByEmail($email);

            if($user && password_verify($password, $user['password'])){
                return [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ];
            }

            return false;
        }

        public function selectUserById(int $id): array{
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            $result = $sql->fetch(PDO::FETCH_ASSOC);

            return  [
                'id'=> $result['id'],
                'name' => $result['name']
            ];
        }
    }