<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\User;

class RegisterController
{
    public function store(): void
    {
        $name = trim($_POST['name'] ?? '');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';

        if (!$name || !$email || !$password) {
            $this->redirectWithMessage('Preencha todos os campos corretamente');
        }

        if (strlen($password) < 6) {
            $this->redirectWithMessage('A senha deve ter no mínimo 6 caracteres');
        }

        $db = new Database();
        $pdo = $db->connect();

        $user = new User($pdo);

        if (!$user->register($name, $email, $password)) {
            $this->redirectWithMessage('Email já cadastrado');
        }

        $this->redirectWithMessage('Usuário cadastrado com sucesso');
    }

    private function redirectWithMessage(string $message): void
    {
        $_SESSION['flash'] = $message;

        header('Location: /socialMedia/Public/signup');
        exit;
    }
}