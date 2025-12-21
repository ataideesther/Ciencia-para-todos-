<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo de Ecologia - Cadeia Alimentar</title>
    <link rel="stylesheet" href="css/jogoEcologia.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="container">
        <div class="header">Ecologia</div>
        <div class="game-area">
            <div class="instruction">Arraste os organismos para a área de montagem na ordem correta:</div>
            <div class="chain-description">Produtor → Consumidor Primário → Consumidor Secundário → Decompositor</div>

            <div class="drop-zone-container">
                <div class="drop-zone">
                    <div class="drop-slot" data-position="1"></div>
                    <div class="drop-slot" data-position="2"></div>
                    <div class="drop-slot" data-position="3"></div>
                    <div class="drop-slot" data-position="4"></div>
                    <div class="drop-slot" data-position="5"></div>
                </div>
            </div>

            <div class="organisms-container">
                <div class="drag-items">
                    <div class="organism" draggable="true" data-type="grama">
                        <img src="imgs/grama.png" alt="Grama">
                        <div class="organism-label">Grama</div>
                    </div>
                    <div class="organism" draggable="true" data-type="sol">
                        <img src="imgs/sol.png" alt="Sol">
                        <div class="organism-label">Sol</div>
                    </div>
                    <div class="organism" draggable="true" data-type="cobra">
                        <img src="imgs/cobra.png" alt="Cobra">
                        <div class="organism-label">Cobra</div>
                    </div>
                    <div class="organism" draggable="true" data-type="gafanhoto">
                        <img src="imgs/gafanhoto.png" alt="Gafanhoto">
                        <div class="organism-label">Gafanhoto</div>
                    </div>
                    <div class="organism" draggable="true" data-type="fungo">
                        <img src="imgs/fungo.png" alt="Fungo">
                        <div class="organism-label">Fungo</div>
                    </div>
                </div>
            </div>

            <div class="controls">
                <button class="confirm-btn">Confirmar</button>
            </div>

            <!-- Overlay para fundo escurecido -->
            <div class="overlay"></div>

            <!-- Mensagem de Sucesso -->
            <div id="mensagem-sucesso" class="mensagem-feedback">
                <div class="feedback-content">
                    <h2>PARABÉNS!</h2>
                    <h3>VOCÊ ACERTOU</h3>
                    <div class="personagem">
                        <img src="imgs/respostaCerta.png" alt="Personagem Feliz" class="imagem-feedback">
                    </div>
                    <button onclick="window.location.href='atividadeEcologia.php'">PRÓXIMO</button>
                </div>
            </div>

            <!-- Mensagem de Erro -->
            <div id="mensagem-erro" class="mensagem-feedback">
                <div class="feedback-content">
                    <h2>VAMOS TENTAR</h2>
                    <h3>NOVAMENTE</h3>
                    <div class="personagem">
                        <img src="imgs/respostaIncorreta.png" alt="Personagem Triste" class="imagem-feedback">
                    </div>
                    <div class="botoes-erro">
                        <button id="botao-tentar" class="botao-feedback">Tentar Novamente</button>
                        <button id="botao-inicio" class="botao-feedback">PÁGINA INICIAL</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jogoEcologia.js"></script>
</body>

</html>