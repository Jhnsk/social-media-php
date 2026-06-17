<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\User;
use App\Core\Controller;


class LoginController extends Controller
{
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/socialMedia/Public/');
        }
    
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';
    
        if (!$email || !$password) {
            $this->redirect('/socialMedia/Public/','Preencha os campos corretamente');
        }
    
        $user = new User((new Database())->connect());
    
        $result = $user->login($email, $password);
    
        if (!$result) {
            $this->redirect('/socialMedia/Public/','Úsuario ou Senha Inválidos');
        }
    
        session_regenerate_id(true);
    
        $_SESSION['user'] = [
            'id' => $result['id'],
            'name' => $result['name'],
            'email' => $result['email']
        ];
    
        $this->redirect('/socialMedia/Public/dashboard');
    }

}