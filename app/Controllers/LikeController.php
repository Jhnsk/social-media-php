<?php

    namespace App\Controllers;

    use App\Config\Database;
    use App\Models\Like;

    class LikeController
    {
        public function like(): void
        {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->redirect('/socialMedia/Public/dashboard');
            }

            if (!isset($_SESSION['user'])) {
                $this->redirect('/socialMedia/Public/');
            }

            $postId = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
            $userId = $_SESSION['user']['id'];

            if (!$postId || $postId <= 0) {
                $this->redirect('/socialMedia/Public/dashboard');
            }

            $pdo = (new Database())->connect();

            $likeModel = new Like($pdo);

            $liked = $likeModel->toggleLike($userId, $postId);
            $likes = $likeModel->getLikesCount($postId);

            header('Content-Type: application/json');

            echo json_encode([
                'liked' => $liked,
                'likes' => $likes
            ]);

            exit;
        }
        private function redirect(string $url): void
        {
            header("Location: {$url}");
            exit;
        }
    }

    
        

    