<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Config\Database;
use App\Models\Comments; 
use App\Models\Follow;
use App\Models\Like;
use App\Models\Post;

class DashboardController extends Controller
{
    public function dashboard(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/socialMedia/Public/');
        }    

    $userId = $_SESSION['user']['id'];
    
    $db = new Database();
    $pdo = $db->connect();

    $postsModel = new Post($pdo);

    $followModel = new Follow($pdo);

    $likesModel = new Like($pdo);

    $commentModel = new Comments($pdo);

    $posts = $postsModel->getPosts($userId);
    
    $suggestions = $followModel->getSuggestions($userId);

    foreach($posts as &$post){
        $post['likesCount'] = $likesModel->getLikesCount($post['id']);
        $post['hasLiked'] = $likesModel->hasLiked($userId, $post['id']);
        $post['comments'] = $commentModel->getComments($post['id']);
    }

    unset($post);

    require '../app/Views/dashboard.php';

    }
}
    
    
    
