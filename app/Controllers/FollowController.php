<?php

    namespace App\Controllers;

    use App\Core\Controller;

    class FollowController extends Controller
    {
        public function follow(): void
        {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->redirect('/socialMedia/Public/dashboard','Método inválido');
            }

            if (!isset($_SESSION['user'])) {
                $this->redirect('/socialMedia/Public/','Faça login novamente');
            }

            $followingId = filter_input(
                INPUT_POST,
                'following_id',
                FILTER_VALIDATE_INT
            );

            $followerId = $_SESSION['user']['id'];

            if (!$followingId || $followingId <= 0) {
                $this->redirect('/socialMedia/Public/dashboard','Usuário inválido');
            }

            $followService = $this->container()->followService();

            $result = $followService->follow($followerId, $followingId);

            if ($result) {
                $this->redirect('/socialMedia/Public/dashboard','Usuário seguido com sucesso');
            }

            $this->redirect('/socialMedia/Public/dashboard','Erro ao seguir usuário');
        }
    }