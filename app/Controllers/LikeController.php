<?php

    namespace App\Controllers;

    use App\Core\Controller;

    class LikeController extends Controller
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

            $likeModel = $this->container()->like();

            $liked = $likeModel->toggleLike($userId, $postId);
            $likes = $likeModel->getLikesCount($postId);

            header('Content-Type: application/json');

            echo json_encode([
                'liked' => $liked,
                'likes' => $likes
            ]);

            exit;
        }
    }

    
        

    