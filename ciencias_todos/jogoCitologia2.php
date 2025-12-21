<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citologia</title>
    <link rel="stylesheet" href="css/jogoCitologia2.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <header>Citologia</header>

    <div class="content-wrapper">
        <div class="container">
            <div class="jogo">
                <div class="pergunta">
                    <p>Realiza a fotossíntese</p>
                    <select id="questao1">
                        <option value="">Selecione</option>
                    </select>
                </div>
                <div class="pergunta">
                    <p>Faz a digestão da célula</p>
                    <select id="questao2">
                        <option value="">Selecione</option>
                    </select>
                </div>
                <div class="pergunta">
                    <p>Produz energia e faz a respiração celular</p>
                    <select id="questao3">
                        <option value="">Selecione</option>
                    </select>
                </div>
                <div class="pergunta">
                    <p>Produz proteína</p>
                    <select id="questao4">
                        <option value="">Selecione</option>
                    </select>
                </div>
                <div class="pergunta">
                    <p>Produção de proteínas e gorduras</p>
                    <select id="questao5">
                        <option value="">Selecione</option>
                    </select>
                </div>
                <div class="pergunta">
                    <p>Armazena água nas células vegetais</p>
                    <select id="questao6">
                        <option value="">Selecione</option>
                    </select>
                </div>
                <div class="pergunta">
                    <p>Faz a divisão celular</p>
                    <select id="questao7">
                        <option value="">Selecione</option>
                    </select>
                </div>
                <div class="pergunta">
                    <p>Entregador das substâncias na célula</p>
                    <select id="questao8">
                        <option value="">Selecione</option>
                    </select>
                </div>
            </div>
            <button id="botao-confirmar">CONFIRMAR</button>
        </div>

        <!-- Mensagem de Sucesso -->
        <div id="mensagem-sucesso" class="mensagem-feedback">
            <div class="feedback-content">
                <h2>PARABÉNS!</h2>
                <h3>VOCÊ ACERTOU</h3>
                <div class="personagem">
                    <img src="imgs/respostaCerta.png" alt="Personagem Feliz" class="imagem-feedback">
                </div>
                <button onclick="window.location.href='atividadeCitologia.php'">PRÓXIMO</button>
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

    <script src="js/jogoCitologia2.js"></script>
</body>

</html>