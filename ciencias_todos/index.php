<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciência Para Todos</title>
    <link rel="stylesheet" href="css/telaInicial.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="center">
        <div class="container">
            <div class="img">
                <img src="imgs/logoCienciaParaTodos.png" alt="Logo Ciência para Todos">
            </div>
            <div class="botao">
                <button class="botao-aluno" onclick="alunoLogin('alunoLogin.php')" id="alunoLogin">ALUNO</button>
                <button class="botao-prof" onclick="profLogin('profLogin.php')">PROFESSOR</button>
            </div>
        </div>
    </div>
    <script src="js/telaInicial.js"></script>
</body>

</html>