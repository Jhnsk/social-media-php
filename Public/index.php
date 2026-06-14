<?php

session_start();

date_default_timezone_set('America/Sao_Paulo');

error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require '../vendor/autoload.php';
    use App\Helpers\time;

$url = $_GET['url'] ?? '';

switch($url){

        case '':
            require '../app/Views/login.php';
            break;

        case 'signup':
            require '../app/Views/register.php';
            break;

        case 'profile':
            require '../app/Controllers/ProfileController.php';
            break; 

        case 'register':
            require '../app/Controllers/RegisterController.php';
            break;

        case 'dashboard':
            require '../app/Controllers/DashboardController.php';
            break;

        case 'login':
            require '../app/Controllers/LoginController.php';
            break;
    
        case 'logout':
            require '../app/Controllers/LogoutController.php';
            break;

        case  'post':
            require '../app/Controllers/PostController.php';
            break;

        case 'following':
            require '../app/Controllers/FollowingController.php';
            break;
        
        case 'like':
            require '../app/Controllers/LikeController.php';
            break;

        case 'comment':
            require '../app/Controllers/CommentsController.php';
            break;
        case 'messenger':
            require '../app/Controllers/MessengerController.php';
            break;
        case 'ajax':
            require '../app/Controllers/AjaxController.php';
            break;

    default:
        echo "404";
}