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
    }