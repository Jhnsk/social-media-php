<?php

    namespace App\Services;

    use App\repositories\FollowRepository;

    class FollowService
    {
        public function __construct(private FollowRepository $followRepository){}

        
    }