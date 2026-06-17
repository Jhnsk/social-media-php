<?php

    namespace App\Controllers;

    use App\Core\Controller;
    use App\Config\Database;
    use App\Models\Comments;

    class CommentsController extends Controller
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


            if ($comment === '') {
                $this->redirect('/socialMedia/Public/dashboard','Escreva um comentário');
            }

            if(!$postId || $postId <= 0){
                $this->redirect('/socialMedia/Public/dashboard','Post Inválido');
            }

            $db = new Database();
            $pdo = $db->connect();

            $commentModel = new Comments($pdo);
            $result = $commentModel->create($userId, $postId, $comment);

            if ($result) {
                $this->redirect('/socialMedia/Public/dashboard','Comentário adicionado com sucesso');
            } else {
                $this->redirect('/socialMedia/Public/dashboard','Erro ao adicionar comentário');
            }
        }
    }
    

   