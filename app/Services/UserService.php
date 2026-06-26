<?php

    namespace App\Services;

    use App\Repositories\UserRepository;

    class UserServices
    {
        public function __construct(private UserRepository $userRepository){}

        public function register(string $name, string $email, string $password)
        {
            if (!$name || !$email || !$password) {
               
            }

            if (strlen($password) < 6) {
                
            }
        }

       
    }