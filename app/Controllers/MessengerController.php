<?php

namespace App\Controllers;

use App\Core\Controller;

class MessengerController extends Controller
{
    public function messenger(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/socialMedia/Public/');
        }

        $userId = $_SESSION['user']['id'];

        $followingService = $this->container()->followService();
        $userService = $this->container()->userService();
        $messengerService = $this->container()->messengerService();

        // Processa envio de mensagem
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $message = trim($_POST['msgText'] ?? '');

            $receiverId = filter_input(
                INPUT_POST,
                'receiver_id',
                FILTER_VALIDATE_INT
            );

            if (!$receiverId || $receiverId <= 0) {
                $this->redirect('/socialMedia/Public/messenger');
            }

            if ($message === '') {
                $this->redirect('/socialMedia/Public/messenger','Escreva uma mensagem');
            }

            $messengerService->createMsg(
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

        $followings = $followingService->getFollowing($userId);

        foreach ($followings as &$following) {

            $lastMessage = $messengerService->getLastMessage(
                $userId,
                $following['id']
            );

            $following['last_message'] =
            $lastMessage['message'] ?? 'Nenhuma mensagem';
        }

        unset($following);

        if ($conversationUser) {

            $selectedUser = $userService->selectUserById(
                $conversationUser
            );

            if (!$selectedUser) {
                $this->redirect('/socialMedia/Public/messenger','Usuário não encontrado');
            }
        }

        require '../app/Views/messenger.php';
    }
}