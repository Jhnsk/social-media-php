<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\Messenger;

class AjaxController
{
    public function ajax(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/socialMedia/Public/');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->redirect('/socialMedia/Public/messenger');
        }

        $senderId = $_SESSION['user']['id'];

        $receiverId = filter_input(
            INPUT_GET,
            'receiver_id',
            FILTER_VALIDATE_INT
        );

        if (!$receiverId || $receiverId <= 0) {
            http_response_code(400);

            echo json_encode([
                'error' => 'Usuário inválido'
            ]);

            exit;
        }

        $pdo = (new Database())->connect();

        $messengerModel = new Messenger($pdo);

        $messages = $messengerModel->getMessages(
            $senderId,
            $receiverId
        );

        header('Content-Type: application/json');

        echo json_encode($messages);

        exit;
    }

    private function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
}