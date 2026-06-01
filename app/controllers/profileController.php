<?php

    require '../app/config/Database.php';
    require '../app/models/Post.php';
    require '../app/models/Follow.php';
    require '../app/models/Like.php';
    require '../app/models/Comments.php';

    if(!isset($_SESSION['user'])){
        header('location: /socialMedia/public/');
        exit;
    }  

    $userId = $_SESSION['user']['id'];

    $db = new Database();
    $pdo = $db->connect();

    $postsUserModel = new Post($pdo);
    $followerModel = new Follow($pdo);
    $getlikes = new Like($pdo);
    $commentModel = new Comments($pdo);

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
    
    require '../app/views/profile.php';

