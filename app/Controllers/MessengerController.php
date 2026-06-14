<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\Follow;
use App\Models\User;
use App\Models\Messenger;

$userId = $_SESSION['user']['id'];

$conversationUser = filter_input(
    INPUT_GET,
    'user',
    FILTER_VALIDATE_INT
);

$selectedUser = null;

$db = new Database();
$pdo = $db->connect();

$followingModel = new Follow($pdo);
$userModel = new User($pdo);
$messengerModel = new Messenger($pdo);

$followings = $followingModel->getFollowing($userId);

foreach($followings as &$following){

    $lastMessage = $messengerModel->getLastMessage(
        $userId,
        $following['id']
    );

    $following['last_message'] = $lastMessage['message'] ?? 'Nenhuma mensagem';
}
unset($following);

if($conversationUser){
    $selectedUser = $userModel->selectUserById($conversationUser);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $message = trim($_POST['msgText'] ?? '');

    $receiverId = filter_input(
        INPUT_POST,
        'receiver_id',
        FILTER_VALIDATE_INT
    );

    if($receiverId === false || $receiverId <= 0){
        die('Usuário inválido');
    }

    if($message === ''){
        die('Digite uma mensagem');
    }

    $messengerModel->createMsg(
        $userId,
        $receiverId,
        $message
    );

    header("Location: messenger?user=$receiverId");
    exit;
}

require '../app/Views/messenger.php';