<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\Messenger;



$sender_id = $_SESSION['user']['id'];
$receiver_id = filter_input(INPUT_GET, 'receiver_id', FILTER_VALIDATE_INT);

if(!$receiver_id || $receiver_id <= 0){
    die('Usuário inválido');
}

$db = new Database();
$pdo = $db->connect();

$messenger = new Messenger($pdo);

$messages = $messenger->getMessages(
    $sender_id,
    $receiver_id
);

header('Content-Type: application/json');

echo json_encode($messages);