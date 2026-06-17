<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Config\Database;
use App\Models\User;

class RegisterController extends Controller
{
    public function store(): void
    {
        $name = trim($_POST['name'] ?? '');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';

        if (!$name || !$email || !$password) {
            $this->redirect('/socialMedia/Public/signup','Preencha os Campos Corretamente');
        }

        if (strlen($password) < 6) {
            $this->redirect('/socialMedia/Public/signup','Senha tem que ter no minimo 6 caracteres');
        }

        $db = new Database();
        $pdo = $db->connect();

        $user = new User($pdo);

        if (!$user->register($name, $email, $password)) {
           $this->redirect('/socialMedia/Public/signup','Email já cadastrado');
        }

        $this->redirect('/socialMedia/Public/');
    }

}