<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introdução à Química</title>
    <link rel="stylesheet" href="css/intQuimica.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include_once('menu.php'); ?>

    <div class="titulo">
        <h1>Introdução à Química</h1>
    </div>

    <div class="atomo-container">
        <div class="atomo-conteudo">
            <img src="imgs/atomoEstrutura.png" alt="Estrutura do Átomo" class="img-atomo">
            <div class="texto-explicativo">
                <div class="bloco">
                    <div class="label">Elétron</div>
                    <p><strong>Elétron</strong> é a parte negativa do átomo, ele fica na eletrosfera circulando o núcleo.</p>
                </div>
                <div class="bloco">
                    <div class="label">Núcleo</div>
                    <p>O <strong>núcleo</strong> fica no centro do átomo, ele é formado por partes positivas, os prótons, e a parte
                        neutra, os nêutrons.</p>
                </div>
                <div class="bloco">
                    <div class="label">Eletrosfera</div>
                    <p><strong>Eletrosfera</strong> é onde o elétron fica.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="substancias-misturas">
        <h2>Substâncias e Misturas</h2>
        <div class="substancias-misturas-container">
            <div class="card">
                <img src="imgs/substanciaSimples.png" alt="Substância Simples">
                <h3>Substância Simples</h3>
                <p>São formadas por apenas um elemento.</p>
            </div>
            <div class="card">
                <img src="imgs/substanciaComposta.png" alt="Substância Composta">
                <h3>Substância Composta</h3>
                <p>São formadas por mais de um elemento.</p>
            </div>
            <div class="card">
                <img src="imgs/misturaHomogenea.png" alt="Mistura Homogênea">
                <h3>Mistura Homogênea</h3>
                <p>Apresentam uma única fase; não permitem a distinção de suas substâncias.</p>
            </div>
            <div class="card">
                <img src="imgs/misturaHeterogenea.png" alt="Mistura Heterogênea">
                <h3>Mistura Heterogênea</h3>
                <p>Apresentam duas ou mais fases; permitem a distinção de suas substâncias.</p>
            </div>
        </div>
        <div class="botao-exercicio">
            <a href="atividadeIntQuimica.php"><button><i class="fas fa-pencil-alt"></i> EXERCÍCIOS</button></a>
            <a href="jogoIntQuimica.php"><button><i class="fas fa-gamepad"></i> JOGO</button></a>
        </div>
    </div>

</body>

</html>