<?php

    namespace App\Controllers;

    use App\Core\Controller;
    
    class ProfileController extends Controller
    {
        public function profile(): void
        {
            if (!isset($_SESSION['user'])) {
                $this->redirect(' /socialMedia/Public/');
            }  

            $userId = $_SESSION['user']['id'];

            $postsUserService = $this->container()->postService();
            $followerService = $this->container()->followService();
            $getlikesService = $this->container()->likeService();
            $commentService = $this->container()->commentService();

            $postsUser = $postsUserService->getUserPosts($userId);
            $followers = array_slice($followerService->getFollowers($userId), 0, 5);
            $followings = array_slice($followerService->getFollowing($userId), 0, 5);

            $postsUserCount = count($postsUser); 
            $followersCount = count($followers);
            $followingsCount = count($followings);

            foreach($postsUser as &$postUser){
                $postUser['likesCount'] = $getlikesService->getLikesCount($postUser['id']);
                $postUser['hasLiked'] = $getlikesService->hasLiked($userId, $postUser['id']);
                $postUser['comments'] = $commentService->getComments($postUser['id']);
            }
            
            require '../app/Views/profile.php';
        }
        
    }
    

