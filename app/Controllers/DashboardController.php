<?php

    namespace App\Controllers;

    use App\Core\Controller;

    class DashboardController extends Controller
    {
        public function dashboard(): void
        {
            if (!isset($_SESSION['user'])) {
                $this->redirect('/socialMedia/Public/');
            }    

        $userId = $_SESSION['user']['id'];
        
        $postsModel = $this->container()->post();

        $followModel = $this->container()->follow();

        $likesService = $this->container()->likeService();

        $commentModel = $this->container()->comment();

        $posts = $postsModel->getPosts($userId);
        
        $suggestions = $followModel->getSuggestions($userId);

        foreach ($posts as &$post) {
            $post['likesCount'] = $likesService->getLikes($post['id']);
            $post['hasLiked'] = $likesService->hasLiked($userId, $post['id']);
            $post['comments'] = $commentModel->getComments($post['id']);
        }

        unset($post);

        require '../app/Views/dashboard.php';

        }
    }
    
    
    
