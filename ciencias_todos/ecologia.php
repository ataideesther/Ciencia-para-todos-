<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecologia | Aprendendo sobre a natureza</title>
    <meta name="description"
        content="Aprenda sobre ecologia, cadeias alimentares e níveis tróficos de forma simples e educativa">
    <link rel="stylesheet" href="css/ecologia.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <header>
        <h1>Ecologia</h1>
    </header>

    <main>
        <section class="card">
            <div class="card-header">
                <h2>O que é Ecologia?</h2>
            </div>
            <p class="intro">A ecologia é a ciência que estuda as relações dos seres vivos entre si e com o ambiente em
                que vivem, incluindo os fatores físicos, químicos e biológicos.</p>
            <div class="content">
                <div class="text-content">
                    <p>A <strong>cadeia alimentar</strong> representa a sequência de organismos em que cada um serve de
                        alimento para o seguinte, estabelecendo uma transferência de energia e matéria através do
                        ecossistema.</p>
                    <p>As cadeias alimentares são fundamentais para o equilíbrio ecológico, pois mostram como a energia
                        flui entre os diferentes organismos e como todos os seres vivos estão interconectados.</p>
                </div>
                <div class="image-container">
                    <img src="imgs/cadeiaAlimentar.png"
                        alt="Representação de uma cadeia alimentar mostrando a transferência de energia entre espécies">
                </div>
            </div>
        </section>

        <section class="card">
            <div class="card-header">
                <h2>Níveis Tróficos</h2>
            </div>
            <p class="intro">Os níveis tróficos são posições na cadeia alimentar que indicam como a energia e os
                nutrientes fluem através do ecossistema.</p>
            <div class="content">
                <div class="image-container">
                    <img src="imgs/niveisTroficos.png"
                        alt="Diagrama ilustrando os diferentes níveis tróficos em um ecossistema">
                </div>
                <div class="text-content">
                    <ul>
                        <li><strong>Produtores:</strong> Organismos autotróficos como plantas e algas que produzem seu
                            próprio alimento através da fotossíntese, transformando energia solar em energia química.
                        </li>
                        <li><strong>Consumidores primários:</strong> Herbívoros que se alimentam diretamente dos
                            produtores, como gafanhotos, zebras e coelhos.</li>
                        <li><strong>Consumidores secundários:</strong> Carnívoros que se alimentam dos consumidores
                            primários, como sapos, cobras e aves de rapina.</li>
                        <li><strong>Consumidores terciários:</strong> Predadores de topo que se alimentam de outros
                            carnívoros, como águias, tubarões e leões.</li>
                        <li><strong>Decompositores:</strong> Fungos e bactérias que decompõem a matéria orgânica morta,
                            reciclando nutrientes de volta para o solo.</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="card">
            <div class="card-header">
                <h2>Fluxo de Energia</h2>
            </div>
            <p class="intro">A energia flui de forma unidirecional através da cadeia alimentar, com perdas
                significativas em cada transferência.</p>
            <div class="content">
                <div class="text-content">
                    <ul>
                        <li>Tudo começa com o sol, que fornece energia para as plantas (produtores).</li>
                        <li>As plantas transformam a energia solar em alimento por fotossíntese.</li>
                        <li>Os herbívoros comem as plantas e absorvem essa energia.</li>
                        <li>Os carnívoros comem os herbívoros e recebem parte da energia.</li>
                        <li>A cada passo, a energia diminui porque parte dela é gasta para manter a vida (respiração,
                            calor, movimento).</li>
                        <li>No final, os decompositores quebram restos de seres vivos e ajudam a reciclar a matéria, mas
                            não a energia (ela não volta — se dissipa como calor).</li>
                    </ul>
                </div>
                <div class="image-container">
                    <img src="imgs/fluxoEnergia.png"
                        alt="Diagrama mostrando o fluxo de energia através dos diferentes níveis tróficos">
                </div>
            </div>
            <div class="button-container">
                <a href="atividadeEcologia.php" class="exercises-button">
                    <i class="fas fa-pencil-alt"></i> EXERCÍCIOS
                </a>
                <a href="jogoEcologia.php" class="exercises-button">
                    <i class="fas fa-gamepad"></i> JOGO
                </a>
            </div>
        </section>
    </main>
</body>

</html>