<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="css/cadastro.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <title>Faça seu cadastro Aluno</title>
</head>

<body>
    <div class="container">
        <div class="logo-container">
            <img src="imgs/logoCienciaParaTodos.png" alt="Ciência para Todos">
        </div>
        <div class="right-side">
            <h1 class="form-title">Faça seu cadastro</h1>
            <form method="POST" action="cadastroAluno.php" id="formcadastro" name="formcadastro">
                <div class="form-group">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" required>
                </div>

                <div class="form-group password-container">
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-input" id="password" required>
                    <i class="bi bi-eye-fill" id="btn-senha" onclick="mostrarSenha()"></i>
                </div>

                <input type="submit" value="Criar Conta">
                <div class="cadastro-container">
                <p>Já tem conta?</p>
                <a href="alunoLogin.php" class="cadastro">Faça o login</a>
            </div>
        </div>
    </div>
    <script src="js/cadastro.js"></script>
</body>

</html>