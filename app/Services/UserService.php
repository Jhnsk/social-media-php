<?php

    namespace App\Services;

    use App\Repositories\UserRepository;

    class UserService
    {
        public function __construct(private UserRepository $userRepository){}

        public function register(string $name, string $email, string $password)
        {
           if (!$name || !$email || !$password) {
            throw new \Exception("preencha os campos corretamente");
           }

           if (strlen($password) < 6) {
            throw new \Exception("senha tem que ter no mínimo 6 caracteres");
           } 

           if ($this->userRepository->FindByEmail($email)) {
            throw new \Exception("usuário já Cadastrado");
           }

           $hash = password_hash($password, PASSWORD_DEFAULT);

           if(!$this->userRepository->create($name, $email, $hash)) {
            throw new \Exception("erro ao cadastrar usuário");
           }

           return true;
        } 
    }