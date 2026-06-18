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

            $postsUserModel = $this->container()->post();
            $followerModel = $this->container()->follow();
            $getlikes = $this->container()->like();
            $commentModel = $this->container()->comment();

            $postsUser = $postsUserModel->getUserPosts($userId);
            $followers = array_slice($followerModel->getFollowers($userId), 0, 5);
            $followings = array_slice($followerModel->getFollowing($userId), 0, 5);

            $postsUserCount = count($postsUser); 
            $followersCount = count($followers);
            $followingsCount = count($followings);

            foreach($postsUser as &$postUser){
                $postUser['likesCount'] = $getlikes->getLikesCount($postUser['id']);
                $postUser['hasLiked'] = $getlikes->hasLiked($userId, $postUser['id']);
                $postUser['comments'] = $commentModel->getComments($postUser['id']);
            }
            
            require '../app/Views/profile.php';
        }
        
    }
    

