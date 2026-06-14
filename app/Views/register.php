
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/socialMedia/Public/assets/css/register.css">
    <title>Registro - Social Media</title>

    </head>
<body>

    <div class="container">

    <?php if(!empty($_SESSION['flash'])): ?>

        <h5> <?= $_SESSION['flash'] ?> </h5>
        <?php unset($_SESSION['flash'])?>

        <?php endif; ?>

        <h1>Registro</h1>

        <div class="message error" id="error"></div>
        <div class="message success" id="success"></div>

        <form id="registerForm" action="/socialMedia/Public/register" method="POST">

            <div class="input-group">
                <label>Nome</label>
                <input 
                    type="text" 
                    name="name"
                    placeholder="Digite seu nome"
                    required
                >
            </div>

            <div class="input-group">
                <label>Email</label>
                <input 
                    type="email" 
                    name="email"
                    placeholder="Digite seu email"
                    required
                >
            </div>

            <div class="input-group">
                <label>Senha</label>
                <input 
                    type="password" 
                    name="password"
                    placeholder="Digite sua senha"
                    required
                >
            </div>

            <button type="submit">
                Criar conta
            </button>

        </form>

        <div class="login-link">
            Já possui conta?
            <a href="/socialMedia/Public/">Entrar</a>
        </div>

    </div>

    

</body>
</html>