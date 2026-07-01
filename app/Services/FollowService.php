<?php

    namespace App\Services;

    use App\repositories\FollowRepository;

    class FollowService
    {
        public function __construct(private FollowRepository $followRepository){}

        public function follow(int $followerId, int $followingId): bool
        {
             $result = $this->followRepository->insertFollow($followerId, $followingId);
             return $result;
        }

        public function getSuggestions(int $userId): array
        {
            $result = $this->followRepository->getSuggestions($userId);
            return $result;
        }

        public function getFollowing(int $userId): array
        {
            $result = $this->followRepository->getFollowing($userId);
            return $result;
        }

        public function getFollowers(int $userId): array
        {
            $result = $this->followRepository->getFollowers($userId);
            return $result;
        }
    }