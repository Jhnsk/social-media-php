<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\Post;

class PostController
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
            $_SESSION['flash'] = "post adicionado com sucesso";
            $this->redirect('/socialMedia/Public/dashboard');
            exit;
        }

        $_SESSION['flash'] = "erro ao publicar";

        $this->redirect('/socialMedia/Public/dashboard');
        
    }

    private function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
}
    
