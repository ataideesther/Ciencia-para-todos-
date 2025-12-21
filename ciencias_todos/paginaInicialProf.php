<?php
session_start();

if (!isset($_SESSION['nome'])) {
    // Redireciona para login se não estiver logado
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Ciencia para todos</title>
    <link rel="stylesheet" type="text/css" href="css/paginaInicialprofessor.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php include_once('menuProfessor.php'); ?>
    <div class="container">
        <h1>BEM VINDO(A), <span id="nome"><?php echo $_SESSION['nome'] ?></span>!</h1>

        <div class="grid">
            <a href="DesempenhoAluno.php">
                <div class="card pink">
                    Desempenho dos <br>Alunos
                </div>
            </a>

            <a href="analiseQuestoes.php">
                <div class="card yellow">
                    Análise Detalhada 
                </div>
            </a>

            <a href="criarTurma.php">
                <div class="card green">
                    Criar turma 
                </div>
            </a>

            <a href="criar_questao.php">
                <div class="card blue">
                    Criar questões
                </div>
            </a>

        </div>

    </div>
</body>

</html>