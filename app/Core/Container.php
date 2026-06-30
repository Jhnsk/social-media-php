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
    use App\Repositories\PostRepository;
    use App\Repositories\FollowRepository;
    use App\Repositories\LikeRepository;
    use App\Services\UserService;
    use App\Services\PostService;
    use App\Services\FollowService;
    use App\Services\LikeService;
    

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
            return new UserService($this->userRepository());
        }

        public function postRepository(): PostRepository
        {
            return new PostRepository($this->pdo());
        }

        public function postService(): PostService
        {
            return new PostService($this->postRepository());
        }

        public function followRepository(): FollowRepository 
        {
            return new FollowRepository($this->pdo());
        }

        public function followService(): FollowService 
        {
            return new FollowService($this->followRepository());
        }

        public function likeRepository(): LikeRepository 
        {
            return new LikeRepository($this->pdo());
        }

        public function likeService(): LikeService 
        {
            return new LikeService($this->likeRepository());
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