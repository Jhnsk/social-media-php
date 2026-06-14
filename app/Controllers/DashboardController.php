<?php
namespace App\Controllers;


    

    use App\Config\Database;
    use App\Models\Post;
    use App\Models\Follow;
    use App\Models\Like;
    use App\Models\Comments; 
    
    if(!isset($_SESSION['user'])){
        header('location: /socialMedia/Public/');
        exit;
    }    

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

    require '../app/Views/dashboard.php';
    
