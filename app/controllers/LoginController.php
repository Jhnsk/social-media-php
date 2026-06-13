<?php

    require '../app/config/Database.php';
    require '../app/models/User.php';

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        die('método inválido');
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if(!$email || !$password){
        $_SESSION['flash'] = "Preencha os campos corretamente";
        header('location: /socialMedia/public/');
        exit;
    }

    try {
    
        $db = new Database();
        $pdo = $db->connect();

        $user = new User($pdo);
        $result = $user->login($email, $password);

        if($result){
            session_regenerate_id(true);

            $_SESSION['user'] = [
                'id' => $result['id'],
                'name' => $result['name'],
                'email' => $result['email']
            ];

            header('location: /socialMedia/public/dashboard');
            exit;
        }

        $_SESSION['flash'] = "Usuário ou senha inválidos";

        header('location: /socialMedia/public/');
        exit;

    }catch(PDOException $e){

        die('Erro interno');
        
    }
