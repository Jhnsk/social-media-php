<?php

session_start();

date_default_timezone_set('America/Sao_Paulo');

error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require '../app/helpers/time.php';

$url = $_GET['url'] ?? '';

switch($url){

        case '':
            require '../app/views/login.php';
            break;

        case 'signup':
            require '../app/views/register.php';
            break;

        case 'profile':
            require '../app/controllers/profileController.php';
            break; 

        case 'register':
            require '../app/controllers/registerController.php';
            break;

        case 'dashboard':
            require '../app/controllers/dashboardController.php';
            break;

        case 'login':
            require '../app/controllers/loginController.php';
            break;
    
        case 'logout':
            require '../app/controllers/logoutController.php';
            break;

        case  'post':
            require '../app/controllers/postController.php';
            break;

        case 'following':
            require '../app/controllers/followingController.php';
            break;
        
        case 'like':
            require '../app/controllers/likeController.php';
            break;

        case 'comment':
            require '../app/controllers/commentsController.php';
            break;
        case 'messenger':
            require '../app/controllers/messengerController.php';
            break;
        case 'ajax':
            require '../app/controllers/ajaxController.php';
            break;

    default:
        echo "404";
}