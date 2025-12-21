<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciência Para Todos</title>
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="css/menu.css">
</head>

<body>
    <button id="menu-btn"><i class="fas fa-bars"></i></button>
    <div class="sidebar">
        <nav>
            <ul class="menu-list">
                <br><br><br>
                <li class="menu-item">
                    <a href="paginaInicialAluno.php"><i class="fas fa-home"></i>Página Inicial</a>
                </li>
                <li class="menu-item">
                    <a href="#"><i class="fas fa-flask"></i> Introdução à Química</a>
                    <ul class="submenu">
                        <li><a href="intQuimica.php">Teoria</a></li>
                        <li><a href="jogoIntQuimica.php">Jogo - Átomo</a></li>
                        <li><a href="jogoIntQuimica2.php">Jogo - Substâncias e Misturas</a></li>
                        <li><a href="atividadeIntQuimica.php">Exercício</a></li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="#"><i class="fas fa-atom"></i> Modelos Atômicos</a>
                    <ul class="submenu">
                        <li><a href="modelosAtomicos.php">Teoria</a></li>
                        <li><a href="jogoModelosAtomicos.php">Jogo</a></li>
                        <li><a href="atividadeModelosAtomicos.php">Exercício</a></li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="#"><i class="fas fa-table"></i> Tabela Periódica</a>
                    <ul class="submenu">
                        <li><a href="tabelaPeriodica.php">Teoria</a></li>
                        <li><a href="jogoTabelaPeriodica.php">Jogo</a></li>
                        <li><a href="tabelaInterativa.php">Tabela Interativa</a></li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="#"><i class="fas fa-link"></i> Ligações Químicas</a>
                    <ul class="submenu">
                        <li><a href="ligacoesQuimicas.php">Teoria</a></li>
                        <li><a href="jogoLigacoesQuimicas.php">Jogo</a></li>
                        <li><a href="atividadeLigacoesQuimicas.php">Exercício</a></li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="#"><i class="fas fa-dna"></i> Citologia</a>
                    <ul class="submenu">
                        <li><a href="citologia.php">Teoria</a></li>
                        <li><a href="jogoCitologia.php">Jogo - Estruturas</a></li>
                        <li><a href="jogoCitologia2.php">Jogo - Organelas</a></li>
                        <li><a href="atividadeCitologia.php">Exercício</a></li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="#"><i class="fas fa-leaf"></i> Ecologia</a>
                    <ul class="submenu">
                        <li><a href="ecologia.php">Teoria</a></li>
                        <li><a href="jogoEcologia.php">Jogo</a></li>
                        <li><a href="atividadeEcologia.php">Exercício</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="footer">
            <img src="imgs/logosesi.png" alt="Logo">
            <div class="logout">
                <a href="sair.php">Sair<i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </div>
    <script src="js/menu.js"></script>
</body>

</html>