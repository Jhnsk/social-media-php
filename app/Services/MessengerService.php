<?php

    namespace App\Services;

    use App\Repositories\MessengerRepository;

    class MessengerService
    {
        public function __construct(private MessengerRepository $messengerRepository){}

        public function createMsg(int $senderId, int $receiverId, string $msgText): bool
        {
            $result = $this->messengerRepository->createMsg($senderId, $receiverId, $msgText);
            return $result;
        }

        public function getMessages(int $userId, int $receiverId): array
        {
            $result = $this->messengerRepository->getMessages($userId, $receiverId);
            return $result;
        }

        public function getLastMessage(int $userId, int $followingId): ?array
        {
            $result = $this->messengerRepository->getLastMessage($userId, $followingId);
            return $result;
        }
    }