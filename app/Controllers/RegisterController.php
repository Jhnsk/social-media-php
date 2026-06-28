<?php

namespace App\Controllers;

use App\Core\Controller;

class RegisterController extends Controller
{
    public function store(): void
    {
        $name = trim($_POST['name'] ?? '');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';

        try{
             $userService = $this->container()->userService();

        if (!$userService->register($name, $email, $password)) {
           $this->redirect('/socialMedia/Public/signup');
        }

        $this->redirect('/socialMedia/Public/');
        
        } catch (\Exception $e) {

            $this->redirect(
                '/socialMedia/Public/signup',
                $e->getMessage()
            );

        }
       
       
    }

}