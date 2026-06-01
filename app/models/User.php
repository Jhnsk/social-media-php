<?php

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


        public function register(string $name,string $email,string $password): bool{

                if($this->findByEmail($email)){
                    return false;
                }

                $hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
                $sql->bindValue(':name', $name);
                $sql->bindValue(':email', $email);
                $sql->bindValue(':password', $hash);

                return $sql->execute();
            
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