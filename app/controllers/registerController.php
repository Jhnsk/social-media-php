<?php

    require '../app/config/Database.php';
    require '../app/models/User.php';

    function redirect(string $message): void{
        $_SESSION['flash'] = $message;
        header('location: /socialMedia/public/signup');
        exit;
    }

    $name = trim($_POST['name'] ?? '');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if(!$name || !$password || !$email){
        redirect("preencha todos os campos corretamente");
    }

    if(strlen($password) < 6){
        redirect("senha tem que ter no minimo 6 caracteres");
    }

    try {

        $db = new Database();
        $pdo = $db->connect();

        $user = new User($pdo);
        $result = $user->register($name, $email, $password);

        if(!$result){
            redirect("email já cadastrado");
        }

        redirect("Usuario cadastrado com sucesso");

    }catch(PDOException $e){

        die('Erro interno');
    }