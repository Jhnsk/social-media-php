<?php

    namespace App\Services;

    use App\Repositories\LikeRepository;

    class LikeService 
    {
        public function __construct(private LikeRepository $likeRepository){}

        public function toggleLike(int $userId, int $postId)
        {
            $liked = $this->likeRepository->toggle($userId, $postId);
            return $liked;
        }

        public function getLikes(int $postId)
        {
            $likes = $this->likeRepository->getLikesCount($postId);
            return $likes;
        }

        public function hasLiked(int $userId, int $postId)
        {
            $hasLiked = $this->likeRepository->hasLiked($userId, $postId);
            return $hasLiked;
        }
    }