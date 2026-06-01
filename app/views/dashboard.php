<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/socialMedia/public/assets/css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>

    <aside class="sidebar">

        <?php if(isset($_SESSION['flash'])):?>
            <h5><?= $_SESSION['flash'] ?></h5>
            <?php unset($_SESSION['flash'])?>
        <?php endif; ?>

        <div>

            <div class="logo">
                DevConnect
            </div>

            <div class="profile">
                <img src="https://placehold.co/120" alt="Foto de perfil">

                <h2><?=$_SESSION['user']['name']?></h2>
                <p><?=$_SESSION['user']['email']?></p>
            </div>

            <nav class="menu">
                <a href="/socialMedia/public/profile">Meu perfil</a>
                <a href="#">Procurar usuários</a>
                <a href="/socialMedia/public/messenger">Mensagens</a>
            </nav>

        </div>

        <form class="form" action="/socialMedia/public/logout" method="POST">
        <button type="submit" name="logout" class="logout">Logout</button>
    </form>

    </aside>

    <main class="feed">

        <section class="create-post">

            <h2>Criar publicação</h2>

            <form action="/socialMedia/public/post" method="POST" enctype="multipart/form-data">

                <textarea placeholder="O que você está pensando?" name="body"></textarea>

                <div class="post-actions">

                    <input type="file" name="image">

                    <button type="submit">Publicar</button>

                </div>

            </form>

        </section>

        <?php foreach($posts as $siglePost): ?>

        <article class="post">

            <div class="post-header">

                <img src="https://placehold.co/60" alt="Usuário">

                <div class="post-user">
                    <h3><?= $siglePost['name']?></h3>
                    <p><?=$siglePost['email']?> • <?= getTimePost($siglePost['created_at']); ?></p>
                </div>

            </div>

            <div class="post-content">
                <p>
                    <?= htmlspecialchars($siglePost['body']); ?>
                </p>

                <?php if(!empty($siglePost['image'])): ?>

                    <img 
                        src="/socialMedia/public/media/uploads/<?= $siglePost['image']; ?>" 
                        alt="Imagem do post"
                    >

                <?php endif; ?>

                <br>
                    <span id="likes-<?= $siglePost['id']; ?>">
                        <?= $siglePost['likesCount']; ?> curtidas
                    </span>
            </div>

            <div class="post-buttons">

                <button 
                    type="button"
                    class="like-btn" 
                    data-id="<?= $siglePost['id']; ?>">

                    <?= $siglePost['hasLiked'] ? 'Descurtir' : 'Curtir'; ?>
                </button>
            
                <button class="comment-btn">Comentar</button>

                <div class="modal-overlay hidden">

                    <div class="comment-modal">

                        <form class="text_area" action="/socialMedia/public/comment" method="POST">

                            <textarea class="textAreaContent"
                                name="comment" 
                                placeholder="Digite seu comentário">
                            </textarea>

                            <input 
                                type="hidden" 
                                name="post_id" 
                                value="<?= $siglePost['id']; ?>"
                            >

                            <button type="submit">Enviar</button>

                        </form>

                    </div>

                </div>
        
                <button>Compartilhar</button>
            </div>

            <div class="comments">

                <?php foreach($siglePost['comments'] as $comment): ?>

                    <div class="comment">

                        <strong>
                            <?= htmlspecialchars($comment['name']); ?>
                        </strong>

                        <p>
                            <?= htmlspecialchars($comment['body']); ?>
                        </p>

                    </div>

                <?php endforeach; ?>

            </div>

        </article>

        <?php endforeach; ?>
       
    </main>

    <aside class="right-sidebar">

        <h2>Usuários sugeridos</h2>

        <?php foreach($suggestions as $suggestUser): ?>

        <div class="suggestion">

            <div class="suggestion-user">
                <img src="https://placehold.co/50" alt="Usuário">

                <div>
                    <h4><?=$suggestUser['name']?></h4>
                    <p><?=$suggestUser['email']?></p>
                </div>
            </div>

        <br><form class="form" action="/socialMedia/public/following" method="POST">

        <input 
                type="hidden" 
                name="following_id" 
                value="<?=$suggestUser['id']?>"
            >

        <button type="submit" class="following">Seguir</button>
    </form>

        </div>

       <?php endforeach; ?>

    </aside>
<script src="/socialMedia/public/assets/js/like.js"></script>
</body>
</html>
