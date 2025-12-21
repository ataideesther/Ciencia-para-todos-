<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Login - Professor</title>
    <link rel="stylesheet" href="css/profLogin.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="container">
        <div class="left-side">
            <div class="logo-container">
                <img src="imgs/logoCienciaParaTodos.png" alt="Ciência para Todos">
            </div>
        </div>

        <div class="right-side">
            <h1 class="form-title">Faça seu Login</h1>

            <form method="POST" action="verificaLoginProf.php" id="formcadastro" name="formcadastro">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" required>
                </div>

                <div class="form-group password-container">
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-input" id="password" required>
                    <i class="bi bi-eye-fill" id="btn-senha" onclick="mostrarSenha()"></i>
                </div>

                <input type="submit" value="Entrar">
            </form>

            <div class="cadastro-container">
                <p>Não tem conta?</p>
                <a href="cadastro.php" class="cadastro">Cadastre-se</a>
            </div>
        </div>
    </div>

    <script src="js/alunoProfLogin.js"></script>
</body>

</html>