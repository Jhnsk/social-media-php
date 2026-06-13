<?php

    require '../app/config/Database.php';
    require '../app/models/Post.php';

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        die("método inválido");
    }

    $body = trim($_POST['body'] ?? '');
    $image = $_FILES['image'] ?? null;
    $userId = $_SESSION['user']['id'];

    $db = new Database();
    $pdo = $db->connect();

    $post = new Post($pdo);
    $result = $post->create($body, $image, $userId);

    if($result){
        $_SESSION['flash'] = "post adicionado com sucesso";
        header('location: /socialMedia/public/dashboard');
        exit;
    }

    $_SESSION['flash'] = "erro ao publicar";

    header('location: /socialMedia/public/dashboard');
    exit;

