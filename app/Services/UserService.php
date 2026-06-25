<?php

    namespace App\Services;

    use App\Repositories\UserRepository;

    class UserService
    {
        public function __construct(private UserRepository $userRepository){}

        public function validateRegister(string $name, string $email, string $password)
        {
            if (!$name || !$email || !$password) {
                throw new \Exception("Preencha os campos corretamente");
            }
        
            if (strlen($password) < 6) {
                throw new \Exception("Senha tem que ter no mínimo 6 caracteres");
            }
        
            if ($this->userRepository->findByEmail($email)) {
                throw new \Exception("Email já cadastrado");
            }
        
            $this->userRepository->createUser($name, $email, $password);
        }

        public function checkLogin(string $email, string $password)
        {
            if (!$email || !$password) {
                throw new \Exception("Preencha os campos corretamente");
            }

            $result = $this->userRepository->findByEmail($email);

            if (!$result || !password_verify($password, $result['password'])) {
                throw new \Exception("Email ou senha inválidos");
            }

                session_regenerate_id(true);

                $_SESSION['user'] = [
                    'id' => $result['id'],
                    'name' => $result['name'],
                    'email' => $result['email']
                ];
            
        }
    }
