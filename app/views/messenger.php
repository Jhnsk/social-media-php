<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger</title>

    <link rel="stylesheet" href="/socialMedia/public/assets/css/messenger.css">
</head>
<body data-user="<?= $_SESSION['user']['id']; ?>">

    <div class="messenger-container">

        <aside class="chat-sidebar">

            <div class="sidebar-header">
                <h2>Mensagens</h2>
            </div>

            <div class="chat-list">
                <?php foreach($followings as $following):?>

                    <a
                        href="/socialMedia/public/messenger?user=<?=$following['id'];?>"
                        class="chat-item"
                    >

                        <img src="https://i.pravatar.cc/100?img=1" alt="Usuário">

                        <div class="chat-info">
                            <strong>
                                <?=htmlspecialchars($following['name']);?>
                            </strong>

                            <p>
                                <?=htmlspecialchars($following['last_message']);?>
                            </p>

                        </div>
                    </a>

                <?php endforeach; ?>
            </div>

            <div class="back">
                <a href="/socialMedia/public/dashboard">< Voltar</a>
            </div>

        </aside>


        <main class="chat-content">

            <header class="chat-header">

                <div class="chat-user">
                    <img src="https://i.pravatar.cc/100?img=1">

                    <div>
                    <?php if($selectedUser): ?>

                        <h2><?= $selectedUser['name']; ?></h2>

                        <?php else: ?>

                        <h2>Selecione uma conversa</h2>

                        <?php endif; ?>
                </div>

            </header>


            <section class="messages-area" data-user="<?= $selectedUser['id'] ?? '';?>">

              
            </section>


            <form class="message-form" action="/socialMedia/public/messenger" name="message" method="POST">

                <input 
                    type="hidden" 
                    name="receiver_id" 
                    value="<?= $selectedUser['id'];?>"
                >

                <textarea placeholder="Digite sua mensagem..." name="msgText"></textarea>

                <button type="submit">Enviar</button>

            </form>
                
        </main>
                
    </div>
    <script src="/socialMedia/public/assets/js/like.js"></script>
</body>
</html>

