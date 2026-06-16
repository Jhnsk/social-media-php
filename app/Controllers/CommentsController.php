<?php

    namespace App\Controllers;

    use App\Config\Database;
    use App\Models\Comments;

    class CommentsController
    {
        public function createComment(): void
        {

            if (!isset($_SESSION['user'])) {
                $this->redirect('/socialMedia/Public/');
            }

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->redirect('/socialMedia/Public/dashboard');
            }

            $userId = $_SESSION['user']['id'];
            $postId = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
            $comment = trim($_POST['comment'] ?? '');


            if($comment === ''){
                $_SESSION['flash'] = 'Escreva um comentário';
                $this->redirect('/socialMedia/Public/dashboard');
            }

            if(!$postId || $postId <= 0){
                $_SESSION['flash'] = 'Post Inválido';
                $this->redirect('/socialMedia/Public/dashboard');
            }

            $db = new Database();
            $pdo = $db->connect();

            $commentModel = new Comments($pdo);
            $result = $commentModel->create($userId, $postId, $comment);

            if ($result) {
                $_SESSION['flash'] = 'Comentário adicionado com sucesso';
            } else {
                $_SESSION['flash'] = 'Erro ao adicionar comentário';
            }
    
            $this->redirect('/socialMedia/Public/dashboard');

        }

        private function redirect(string $url): void
        {
        header("Location: {$url}");
        exit;
        }
    }
    

   