<?php

    if(!isset($_SESSION['user'])){
        header('location: /socialMedia/public/');
        exit;
    }    

    require '../app/config/Database.php';
    require '../app/models/Post.php';
    require '../app/models/Follow.php';
    require '../app/models/Like.php';
    require '../app/models/Comments.php';

    $userId = $_SESSION['user']['id'];
    
    $db = new Database();
    $pdo = $db->connect();

    $getPosts = new Post($pdo);

    $follow = new Follow($pdo);

    $getlikes = new Like($pdo);

    $gComments = new Comments($pdo);

    $posts = $getPosts->getPosts($userId);
    
    $suggestions = $follow->getSuggestions($userId);

    foreach($posts as &$post){
        $post['likesCount'] = $getlikes->getLikesCount($post['id']);
        $post['hasLiked'] = $getlikes->hasLiked($userId, $post['id']);
        $post['comments'] = $gComments->getComments($post['id']);
    }

    require '../app/views/dashboard.php';
    
