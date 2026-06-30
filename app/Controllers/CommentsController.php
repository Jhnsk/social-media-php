<?php

    namespace App\Controllers;

    use App\Core\Controller;

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

            try
            {
                $commentService = $this->container()->commentService();
                $result = $commentService->create($userId, $postId, $comment);

                if (!$result) {
                    throw new \Exception('Erro ao adicionar comentário');
                }
            
                $this->redirect(
                    '/socialMedia/Public/dashboard',
                    'Comentário adicionado com sucesso'
                );

            } catch(\Exception $e) {
                $this->redirect("/socialMedia/Public/dashboard",
                $e->getMessage());
            }

        }
    }
    

   