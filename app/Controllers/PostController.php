<?php

    namespace App\Controllers;

    use App\Config\Database;
    use App\Models\Post;

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
        header('location: /socialMedia/Public/dashboard');
        exit;
    }

    $_SESSION['flash'] = "erro ao publicar";

    header('location: /socialMedia/Public/dashboard');
    exit;

