<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Ciencia para todos</title>
    <link rel="stylesheet" type="text/css" href="css/paginaInicialAluno.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="container">
        <h1>BEM VINDO(A), <span id="nome"><?php echo $_SESSION['nome'] ?></span>!</h1>

        <div class="grid">
            <a href="intQuimica.php">
                <div class="card pink">
                    Introdução à<br>Química
                </div>
            </a>

            <a href="modelosAtomicos.php">
                <div class="card yellow">
                    Modelos<br>Atômicos
                </div>
            </a>

            <a href="tabelaPeriodica.php">
                <div class="card purple">
                    Tabela Periódica
                </div>
            </a>

            <a href="ligacoesQuimicas.php">
                <div class="card green">
                    Ligações<br>Químicas
                </div>
            </a>

            <a href="citologia.php">
                <div class="card dark-purple">
                    Citologia
                </div>
            </a>

            <a href="ecologia.php">
                <div class="card blue">
                    Ecologia
                </div>
            </a>
        </div>

    </div>
</body>

</html>