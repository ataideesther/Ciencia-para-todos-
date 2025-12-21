<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="css/menu.css">
</head>

<body>
    <?php
        if(!isset($_SESSION['id_aluno'])){
            //header('Location: sair.php', true, 301);
        }
    ?>
    <button id="menu-btn">
        <i class="fas fa-bars"></i>
    </button>
    <div class="overlay" id="overlay"></div>
    <div class="sidebar">
        <nav>
            <br><br><br>
            <a href="paginaInicialProf.php"><i class="fas fa-home"></i> Início</a>
            <a href="desempenhoAluno.php"><i class="fas fa-flask"></i> Desenpenho dos <br> alunos</a>
            <a href="analiseQuestoes.php"><i class="fas fa-atom"></i> Analise das <br> questões</a>
            <a href="criarTurma.php"><i class="fas fa-link"></i> Criar  turma </a>
            <a href="criar_questao.php"><i class="fas fa-question-circle"></i> Criar  questão </a>
        </nav>
        <div class="footer">
            <div class="logout">
            <a href="sair.php">Sair<i class="fas fa-sign-out-alt"></i></a>
            </div>
            <div class="sesi">
                <img src="imgs/logosesi.png" alt="SESI SENAI">
            </div>
        </div>
    </div>
    <script src="js/menu.js">
        
    </script>
</body>

</html>