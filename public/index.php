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
            require '../app/controllers/ProfileController.php';
            break; 

        case 'register':
            require '../app/controllers/RegisterController.php';
            break;

        case 'dashboard':
            require '../app/controllers/DashboardController.php';
            break;

        case 'login':
            require '../app/controllers/LoginController.php';
            break;
    
        case 'logout':
            require '../app/controllers/LogoutController.php';
            break;

        case  'post':
            require '../app/controllers/PostController.php';
            break;

        case 'following':
            require '../app/controllers/FollowingController.php';
            break;
        
        case 'like':
            require '../app/controllers/LikeController.php';
            break;

        case 'comment':
            require '../app/controllers/CommentsController.php';
            break;
        case 'messenger':
            require '../app/controllers/MessengerController.php';
            break;
        case 'ajax':
            require '../app/controllers/AjaxController.php';
            break;

    default:
        echo "404";
}