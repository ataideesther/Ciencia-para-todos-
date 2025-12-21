<!-- jogo1.html -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citologia</title>
    <link rel="stylesheet" href="css/jogoCitologia.css">
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
                    <p>Líquido celular</p>
                    <select id="questao1">
                        <option value="">Selecione</option>
                    </select>
                </div>
                <div class="pergunta">
                    <p>"Segurança" da célula</p>
                    <select id="questao2">
                        <option value="">Selecione</option>
                    </select>
                </div>
                <div class="pergunta">
                    <p>Protege a célula vegetal</p>
                    <select id="questao3">
                        <option value="">Selecione</option>
                    </select>
                </div>
                <div class="pergunta">
                    <p>Guarda o DNA</p>
                    <select id="questao4">
                        <option value="">Selecione</option>
                    </select>
                </div>
            </div>
            <button onclick="confirmar()">CONFIRMAR</button>
        </div>

        <!-- Mensagem de Sucesso -->
        <div id="mensagem-sucesso" class="mensagem-feedback">
            <div class="feedback-content">
                <h2>PARABÉNS!</h2>
                <h3>VOCÊ ACERTOU</h3>
                <div class="personagem">
                    <img src="imgs/respostaCerta.png" alt="Personagem Feliz" class="imagem-feedback">
                </div>
                <button onclick="window.location.href='jogoCitologia2.php'">PRÓXIMO</button>
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
                    <button id="botao-tentar">TENTAR NOVAMENTE</button>
                    <button onclick="window.location.href='paginaInicialAluno.php'">PÁGINA INICIAL</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jogoCitologia.js"></script>
</body>

</html>