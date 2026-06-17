<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Config\Database;
use App\Models\Follow;
use App\Models\User;
use App\Models\Messenger;

class MessengerController extends Controller
{
    public function messenger(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/socialMedia/Public/');
        }

        $userId = $_SESSION['user']['id'];

        $pdo = (new Database())->connect();

        $followingModel = new Follow($pdo);
        $userModel = new User($pdo);
        $messengerModel = new Messenger($pdo);

        // Processa envio de mensagem
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $message = trim($_POST['msgText'] ?? '');

            $receiverId = filter_input(
                INPUT_POST,
                'receiver_id',
                FILTER_VALIDATE_INT
            );

            if (!$receiverId || $receiverId <= 0) {
                $this->redirect('/socialMedia/Public/messenger','Usuário inválido');
            }

            if ($message === '') {
                $this->redirect('/socialMedia/Public/messenger','Escreva uma mensagem');
            }

            $messengerModel->createMsg(
                $userId,
                $receiverId,
                $message
            );

            $this->redirect(
                "/socialMedia/Public/messenger?user={$receiverId}"
            );
        }

        // Carrega a tela
        $conversationUser = filter_input(
            INPUT_GET,
            'user',
            FILTER_VALIDATE_INT
        );

        $selectedUser = null;

        $followings = $followingModel->getFollowing($userId);

        foreach ($followings as &$following) {

            $lastMessage = $messengerModel->getLastMessage(
                $userId,
                $following['id']
            );

            $following['last_message'] =
                $lastMessage['message'] ?? 'Nenhuma mensagem';
        }

        unset($following);

        if ($conversationUser) {

            $selectedUser = $userModel->selectUserById(
                $conversationUser
            );

            if (!$selectedUser) {
                $this->redirect('/socialMedia/Public/messenger','Usuário não encontrado');
            }
        }

        require '../app/Views/messenger.php';
    }
}