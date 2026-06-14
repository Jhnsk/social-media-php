<?php

     namespace App\Controllers;

    use App\Config\Database;
    use App\Models\Comments;

    $userId = $_SESSION['user']['id'];
    $postId = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
    $comment = trim($_POST['comment'] ?? '');

    if($comment === ''){
        die("Escreva algo");
    }

    if(!$postId || $postId <= 0){
        die("comando inválido");
    }

    try{

        $db = new Database();
        $pdo = $db->connect();

        $commentObj = new Comments($pdo);
        $result = $commentObj->create($userId, $postId, $comment);

        if($result){
            header('location: /socialMedia/Public/dashboard');
            exit;
        }else{
            echo "Algo deu errado, comente novamente";
        }

    }catch(PDOException $e){

        die("erro interno");
        
    }