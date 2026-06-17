<?php

    namespace App\Controllers;

    use App\Core\Controller;

    class LogoutController extends Controller
    {
        public function logout(): void
        {
            $_SESSION = [];

            session_destroy();

            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }

        $this->redirect('/socialMedia/Public/');
                
        }
    }

