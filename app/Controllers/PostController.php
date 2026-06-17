<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Config\Database;
use App\Models\Post;

class PostController extends Controller
{
    public function post(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/socialMedia/Public/dashboard');
        }

        if (!isset($_SESSION['user'])) {
            $this->redirect('/socialMedia/Public/');
        }

        $body = trim($_POST['body'] ?? '');
        $image = $_FILES['image'] ?? null;
        $userId = $_SESSION['user']['id'];

        $db = new Database();
        $pdo = $db->connect();

        $postModel = new Post($pdo);
        $result = $postModel->create($body, $image, $userId);

        if($result){
            $this->redirect('/socialMedia/Public/dashboard','post adicionado com sucesso');
        }

        $this->redirect('/socialMedia/Public/dashboard','erro ao publicar');

    }
}
    
