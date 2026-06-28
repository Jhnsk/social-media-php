<?php

    namespace App\Core;

    use App\Config\Database;
    use App\Models\User;
    use App\Models\Comments; 
    use App\Models\Follow;
    use App\Models\Like;
    use App\Models\Post;
    use App\Models\Messenger;
    use App\Repositories\UserRepository;
    use App\Services\UserService;
    

    use PDO;

    class Container
    {
        private ?PDO $pdo = null;

        public function pdo(): PDO
        {
            if ($this->pdo === null) {
                $this->pdo = (new Database())->connect();
            }

            return $this->pdo;
        }

        
        public function userRepository(): UserRepository
        {
            return new userRepository($this->pdo());
        }

        public function userService(): UserService
        {
            return new UserService(
                $this->userRepository()
            );
        }


        public function user(): User 
        {
            return new User($this->pdo());
        }

        public function post(): Post 
        {
            return new Post($this->pdo());
        }

        public function follow(): Follow 
        {
            return new Follow($this->pdo());
        }

        public function like(): Like 
        {
            return new Like($this->pdo());
        }

        public function comment(): Comments 
        {
            return new Comments($this->pdo());
        }

        public function messenger(): Messenger 
        {
            return new Messenger($this->pdo());
        }
    }