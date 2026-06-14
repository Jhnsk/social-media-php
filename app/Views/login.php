
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/socialMedia/Public/assets/css/login.css">
    <title>Login - Social Media</title>

</head>
<body>

    <div class="container">
        <?php if(isset($_SESSION['flash'])): ?>

            <p><?= $_SESSION['flash']; ?></p>

            <?php unset($_SESSION['flash']); ?>

        <?php endif; ?>

        <h1>Login</h1>

    <div class="error" id="error"></div>

    <form id="loginForm" action="/socialMedia/Public/login" method="POST">

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
            Entrar
        </button>

    </form>

        <div class="register-link">
            Não possui conta?
            <a href="/socialMedia/Public/signup">Criar conta</a>
        </div>

    </div>


</body>
</html>