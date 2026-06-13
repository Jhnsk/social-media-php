<?php

    require '../app/config/Database.php';
    require '../app/models/Follow.php';

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        die("Metodo inválido");
    }

    $followingId = filter_input(INPUT_POST, 'following_id', FILTER_VALIDATE_INT);
    $followerId = $_SESSION['user']['id'];

    function redirect(string $message): void{
        $_SESSION['flash'] = $message;
        header('location: /socialMedia/public/dashboard');
        exit;
    }

    if(!$followingId || $followingId <= 0){
        redirect("Usuario Inválido");
    }

    try{

        $db = new Database();
        $pdo = $db->connect();

        $newFollower = new Follow($pdo);
        $res = $newFollower->following($followerId, $followingId);

        if($res){
            redirect("usuario seguido com sucesso");
        }

        redirect("Erro ao seguir usuário");

    }catch(PDOException $e){
        die("erro interno");
    }



