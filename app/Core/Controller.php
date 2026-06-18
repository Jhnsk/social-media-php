<?php

    namespace App\Core;

    abstract class Controller 
    {
       protected  function redirect(string $url, string $message = ''): void 
        {
            if ($message !== ''){
                $_SESSION['flash'] = $message;
            }
            header("Location: {$url}");
            exit;
        }

        protected function container(): Container
        {
            return new Container();
        }
    }