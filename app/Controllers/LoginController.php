<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\User;

class LoginController
{
    public function login(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';

        if (!$email || !$password) {
            $_SESSION['flash'] = 'Preencha os campos corretamente';

            $this->redirect('/socialMedia/Public/');
        }

        $db = new Database();
        $pdo = $db->connect();

        $user = new User($pdo);
        $result = $user->login($email, $password);

        if (!$result) {
            $_SESSION['flash'] = 'Usuário ou senha inválidos';

            $this->redirect('/socialMedia/Public/');
        }

        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id' => $result['id'],
            'name' => $result['name'],
            'email' => $result['email']
        ];

        $this->redirect('/socialMedia/Public/dashboard');
    }

    private function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
}