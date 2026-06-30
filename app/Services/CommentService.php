<?php

    namespace App\Services;

    use App\Repositories\CommentRepository;

    class CommentService 
    {
        public function __construct(private CommentRepository $commentRepository){}

        public function create(int $userId, int $postId, string $comment): bool 
        {
            if ($comment === '') {
                throw new \Exception("Escreva um comentário");
            }

            if ($postId <= 0) {
                throw new \Exception("Post Inválido");
            }

            return $this->commentRepository->create( $userId,  $postId, $comment);
        }

        public function getComments(int $postId): array
        {
            $result = $this->commentRepository->getComments($postId);
            return $result;
        }
    }