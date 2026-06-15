<?php

    session_start();

    date_default_timezone_set('America/Sao_Paulo');

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require '../vendor/autoload.php';
    use App\Helpers\time;
    use App\Controllers\RegisterController;
    use App\Controllers\LoginController;
    use App\Controllers\DashboardController;
    use App\Controllers\PostController;
    use App\Controllers\LikeController;

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
            
                $controller = new RegisterController();
                $controller->store();
            
                break;

        case 'dashboard':
            
            $controller = new DashboardController();
            $controller->dashboard();

            break;

        case 'login':
            
            $login = new LoginController();
            $login->login();

            break;
    
        case 'logout':
            require '../app/Controllers/LogoutController.php';
            break;

        case  'post':
            
            $post = new PostController();
            $post->post();

            break;

        case 'following':
            require '../app/Controllers/FollowingController.php';
            break;
        
        case 'like':
            
            $like = new LikeController();
            $like->like();

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