<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tabela Periódica</title>
  <link rel="stylesheet" href="css/jogoTabelaPeriodica.css">
  <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body>
  <?php
  include_once('menu.php');
  ?>

  <header>Tabela Periódica</header>
  <h2>Indique os elementos dos materiais:</h2>

  <div class="game-container" id="game">
    <!-- Cada item -->
    <div class="item" data-answer="Hidrogênio">
      <img src="imgs/sol.png" alt="Sol">
      <select>
        <option value="">Selecione</option>
      </select>
    </div>
    <div class="item" data-answer="Ouro">
      <img src="imgs/moedas.png" alt="Baú de ouro">
      <select>
        <option value="">Selecione</option>
      </select>
    </div>
    <div class="item" data-answer="Ferro">
      <img src="imgs/fusca.png" alt="Carro">
      <select>
        <option value="">Selecione</option>
      </select>
    </div>
    <div class="item" data-answer="Carbono">
      <img src="imgs/diamante.png" alt="Diamante">
      <select>
        <option value="">Selecione</option>
      </select>
    </div>
    <div class="item" data-answer="Urânio">
      <img src="imgs/bombas.png" alt="Bombas">
      <select>
        <option value="">Selecione</option>
      </select>
    </div>
    <div class="item" data-answer="Lítio">
      <img src="imgs/bateria.png" alt="Bateria">
      <select>
        <option value="">Selecione</option>
      </select>
    </div>
    <div class="item" data-answer="Alumínio">
      <img src="imgs/lata.png" alt="Lata de refri">
      <select>
        <option value="">Selecione</option>
      </select>
    </div>
    <div class="item" data-answer="Prata">
      <img src="imgs/anel.png" alt="Anéis">
      <select>
        <option value="">Selecione</option>
      </select>
    </div>
    <div class="item" data-answer="Mercúrio">
      <img src="imgs/termometro.png" alt="Termômetro">
      <select>
        <option value="">Selecione</option>
      </select>
    </div>
    <div class="item" data-answer="Nitrogênio">
      <img src="imgs/fertilizante.png" alt="Fertilizante">
      <select>
        <option value="">Selecione</option>
      </select>
    </div>
    <div class="item" data-answer="Oxigênio">
      <img src="imgs/tubo-oxigenio.png" alt="Oxigênio">
      <select>
        <option value="">Selecione</option>
      </select>
    </div>
    <div class="item" data-answer="Fósforo">
      <img src="imgs/atp.png" alt="ATP">
      <select>
        <option value="">Selecione</option>
      </select>
    </div>
  </div>

  <button class="button-confirm" onclick="verificarRespostas()">CONFIRMAR</button>

  <!-- Overlay de feedback para acertos -->
  <div class="feedback-overlay" id="success-feedback" style="display: none;">
    <div class="feedback-container success">
      <div class="feedback-title">PARABÉNS!</div>
      <div class="feedback-subtitle">VOCÊ ACERTOU</div>
      <div class="feedback-icon">
        <img src="imgs/respostaCerta.png" alt="Personagem feliz">
      </div>
      <div class="feedback-buttons">
        <button class="feedback-button success-button" onclick="proximoModulo()">Próximo Módulo</button>
      </div>
    </div>
  </div>

  <!-- Overlay de feedback para erros -->
  <div class="feedback-overlay" id="error-feedback" style="display: none;">
    <div class="feedback-container error">
      <div class="feedback-title">VAMOS TENTAR NOVAMENTE</div>
      <div class="feedback-icon">
        <img src="imgs/respostaIncorreta.png" alt="Mascote com livro">
</div>
      <div class="feedback-buttons">
        <button class="feedback-button retry-button" onclick="tentarNovamente()">TENTE NOVAMENTE</button>
        <button class="feedback-button home-button" onclick="irParaInicio()">Página Inicial</button>
      </div>
    </div>
  </div>
  <script src="js/jogoTabelaPeriodica.js"></script>
</body>

</html>