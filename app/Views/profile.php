<?php use function App\Helpers\getTimePost;?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/socialMedia/Public/assets/css/profile.css">
    <title>Perfil</title>

</head>
<body>

    <div class="container">

        <div class="back">
            <a href="/socialMedia/Public/dashboard">< Voltar</a>
        </div>

        <section class="profile-header">

            <img src="https://i.pravatar.cc/300" alt="Foto" class="profile-photo">

            <div class="profile-info">
                <h1><?= $_SESSION['user']['name'] ?></h1>
                <p>Desenvolvedor PHP • Aprendendo Pentest • Criando minha rede social</p>

                <div class="profile-stats">

                    <div class="stat-box">
                        <h3><?= $postsUserCount; ?></h3>
                        <span>Posts</span>
                    </div>

                    <div class="stat-box">
                        <h3><?= $followersCount?></h3>
                        <span>Seguidores</span>
                    </div>

                    <div class="stat-box">
                        <h3><?=$followingsCount;?></h3>
                        <span>Seguindo</span>
                    </div>

                </div>
            </div>

        </section>


        <div class="layout">

            <aside class="sidebar">

                <div class="card">
                    <h2>Seguidores</h2>

                    <div class="followers-list">
                    <?php foreach($followers as $follower): ?>
                        <div class="user-item">
                            <img src="https://i.pravatar.cc/100?img=1">
                            <span><?=$follower['name']?></span>
                        </div>
                        <?php endforeach;?>
                        

                    </div>
                </div>


                <div class="card">
                    <h2>Seguindo</h2>

                    <div class="following-list">
                    <?php foreach($followings as $following): ?>
                        <div class="user-item">
                            <img src="https://i.pravatar.cc/100?img=4">
                            <span><?=$following['name']?></span>
                        </div>
                    <?php endforeach; ?>
                        

                    </div>
                </div>


                <div class="card">
                    <h2>Fotos</h2>

                    <div class="photos-grid">
                        <img src="https://picsum.photos/200?1">
                        <img src="https://picsum.photos/200?2">
                        <img src="https://picsum.photos/200?3">
                        <img src="https://picsum.photos/200?4">
                        <img src="https://picsum.photos/200?5">
                        <img src="https://picsum.photos/200?6">
                    </div>
                </div>

            </aside>


    <main class="content">

        <div class="card create-post">

                    <h2>Criar Post</h2>

                    <form action="/socialMedia/Public/post" method="POST" enctype="multipart/form-data">

                    <textarea placeholder="O que você está pensando?" name="body"></textarea>

                <div class="post-actions">

                    <input type="file" name="image">

                    <button type="submit">Publicar</button>

                </div>

            </form>

        </div>


            <?php foreach($postsUser as $postUser): ?>

            <article class="post">

                <div class="post-header">

                    <img src="https://i.pravatar.cc/300" alt="Usuário">

                    <div class="post-user">
                        <h3><?= $_SESSION['user']['name']?></h3>
                        <p><?=$_SESSION['user']['email']?> • <?= getTimePost($postUser['created_at']); ?></p>
                    </div>

                </div>

                <div class="post-content">
                    <p>
                        <?= htmlspecialchars($postUser['body']); ?>
                    </p>

                    <?php if(!empty($postUser['image'])): ?>

                        <img 
                            src="/socialMedia/Public/media/uploads/<?= $postUser['image']; ?>" 
                            alt="Imagem do post"
                        >

                    <?php endif; ?>

                    <br>
                        <span id="likes-<?= $postUser['id']; ?>">
                            <?= $postUser['likesCount']; ?> curtidas
                        </span>
                </div>

                <div class="post-buttons">

                    <button 
                        type="button"
                        class="like-btn" 
                        data-id="<?= $postUser['id']; ?>">

                        <?= $postUser['hasLiked'] ? 'Descurtir' : 'Curtir'; ?>
                    </button>
                
                    <button class="comment-btn">Comentar</button>

                    <div class="modal-overlay hidden">

                        <div class="comment-modal">

                            <form class="text_area" action="/socialMedia/Public/comment" method="POST">

                                <textarea class="textAreaContent"
                                    name="comment" 
                                    placeholder="Digite seu comentário">
                                </textarea>

                                <input 
                                    type="hidden" 
                                    name="post_id" 
                                    value="<?= $postUser['id']; ?>"
                                >

                                <button type="submit">Enviar</button>

                            </form>

                        </div>

                    </div>

                

                    <button>Compartilhar</button>
                </div>

                <div class="comments">

                    <?php foreach($postUser['comments'] as $comment): ?>

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

        </div>

    </div>
    <script src="/socialMedia/Public/assets/js/like.js"></script>
</body>
</html>
