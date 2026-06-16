<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\Follow;

class FollowController
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

        $pdo = (new Database())->connect();

        $followModel = new Follow($pdo);

        $result = $followModel->follow(
            $followerId,
            $followingId
        );

        if ($result) {
            $this->redirect('/socialMedia/Public/dashboard','Usuário seguido com sucesso');
        }

        $this->redirect('/socialMedia/Public/dashboard','Erro ao seguir usuário');
    }

    private function redirect(string $url, string $message = ''): void
    {
        if ($message !== '') {
            $_SESSION['flash'] = $message;
        }

        header("Location: {$url}");
        exit;
    }
}