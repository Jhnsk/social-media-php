<?php

    use App\Controllers\AjaxController;
    use App\Controllers\CommentsController;
    use App\Controllers\DashboardController;
    use App\Controllers\FollowController;
    use App\Controllers\LoginController;
    use App\Controllers\LikeController;
    use App\Controllers\LogoutController;
    use App\Controllers\MessengerController;
    use App\Controllers\PostController;
    use App\Controllers\ProfileController;
    use App\Controllers\RegisterController;
    use App\Helpers\time;

    session_start();

    date_default_timezone_set('America/Sao_Paulo');

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require '../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();

    $url = $_GET['url'] ?? '';

    switch($url){

        case '':
            require '../app/Views/login.php';
            break;

        case 'signup':
            require '../app/Views/register.php';
            break;

        case 'profile':

            $controller = new ProfileController();
            $controller->profile();

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
            
            $controller = new LoginController();
            $controller->login();

            break;

        case 'logout':
            
            $controller = new LogoutController();
            $controller->logout();

            break;

        case  'post':
            
            $controller = new PostController();
            $controller->post();

            break;

        case 'follow':

            $controller = new FollowController();
            $controller->follow();

            break;
        
        case 'like':
            
            $controller = new LikeController();
            $controller->like();

            break;

        case 'comment':

            $controller = new CommentsController();
            $controller->createComment();

            break;

        case 'messenger':

            $controller = new MessengerController();
            $controller->messenger();

            break;

        case 'ajax':

            $controller = new AjaxController();
            $controller->ajax();

            break;

        default:
            http_response_code(404);
            echo "Página não encontrada";
    }