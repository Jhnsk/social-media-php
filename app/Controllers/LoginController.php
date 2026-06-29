<?php

    namespace App\Controllers;

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

            try {

                $userService = $this->container()->userService();
                
                $user = $userService->checkLogin($email, $password);

                session_regenerate_id(true);

                $_SESSION['user'] = $user;

                $this->redirect('/socialMedia/Public/dashboard');

            } catch (\Exception $e) {

                $this->redirect(
                    '/socialMedia/Public/',
                    $e->getMessage()
                );
            }
        }

    }