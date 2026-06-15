<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\User;

class LoginController
{
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/socialMedia/Public/');
        }
    
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';
    
        if (!$email || !$password) {
            $this->backWithMessage('Preencha os campos corretamente');
        }
    
        $user = new User((new Database())->connect());
    
        $result = $user->login($email, $password);
    
        if (!$result) {
            $this->backWithMessage('Usuário ou senha inválidos');
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