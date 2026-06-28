<?php

    namespace App\Services;

    use App\Repositories\UserRepository;

    class UserService
    {
        public function __construct(private UserRepository $userRepository){}

        public function register(string $name, string $email, string $password): bool
        {
           if (!$name || !$email || !$password) {
            throw new \Exception("preencha os campos corretamente");
           }

           if (strlen($password) < 6) {
            throw new \Exception("senha tem que ter no mínimo 6 caracteres");
           } 

           if ($this->userRepository->findByEmail($email)) {
            throw new \Exception("usuário já Cadastrado");
           }

           $hash = password_hash($password, PASSWORD_DEFAULT);

           if(!$this->userRepository->create($name, $email, $hash)) {
            throw new \Exception("erro ao cadastrar usuário");
           }

           return true;
        } 

        public function checkLogin(string $email, string $password): array
        {
            if (!$email || !$password){
                throw new \Exception("preencha os campos corretamente");
            }

            $user = $this->userRepository->findByEmail($email);

            if (!$user || !password_verify($password, $user['password'])) {
                throw new \Exception("Usuário ou senha Inválido");
            }

            return [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ];
        }
    }