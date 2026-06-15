<?php

    namespace App\Controllers;

    use App\Config\Database;
    use App\Models\Like;

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        die("comando inválido");
    }

    $postId = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);

    $userId = $_SESSION['user']['id'];

    if(!$postId || $postId <= 0){
        die("post inválido");
    }

    try{

        $db = new Database();
        $pdo = $db->connect();

        $like = new Like($pdo);

        $liked = $like->toggleLike($userId, $postId);

        $likes = $like->getLikesCount($postId);

        header('Content-Type: application/json');

        echo json_encode([
            'liked' => $liked,
            'likes' => $likes
        ]);

        exit;

    }catch(PDOException $e){

        die($e->getMessage());

    }