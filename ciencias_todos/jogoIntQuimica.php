<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Introdução à Química</title>
  <link rel="stylesheet" href="css/jogoIntQuimica.css">
  <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body>
  <header>Introdução à Química</header>
  <?php
  include_once('menu.php');
  ?>

  <div class="container">
    <div class="instructions">
      <h3>Estrutura do Átomo</h3>
      <p>Arraste os conceitos corretos para cada parte do átomo para aprender sobre sua estrutura.</p>
    </div>

    <div class="atom-animation">
      <div class="atom-orbit"></div>
      <div class="atom-orbit"></div>
      <div class="atom-orbit"></div>
    </div>

    <div class="image-area">
      <img src="imgs/atomojogo.png" alt="átomo">
      <div class="drop-box" data-index="0" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
      <div class="drop-box" data-index="1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
      <div class="drop-box" data-index="2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    </div>

    <div class="labels">
      <p>Arraste o conceito para o desenho:</p>
      <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
        <div class="progress-text">0/3 conceitos posicionados</div>
      </div>
      
      <div id="label1" class="draggable" draggable="true" ondragstart="drag(event)">Eletrosfera</div>
      <div class="concept-tip" id="tip1">Região ao redor do núcleo onde ficam os elétrons.</div>
      
      <div id="label2" class="draggable" draggable="true" ondragstart="drag(event)">Núcleo</div>
      <div class="concept-tip" id="tip2">Parte central do átomo que contém prótons e nêutrons.</div>
      
      <div id="label3" class="draggable" draggable="true" ondragstart="drag(event)">Elétron</div>
      <div class="concept-tip" id="tip3">Partícula de carga negativa que orbita ao redor do núcleo.</div>

      <button class="confirm-button" onclick="checkAnswers()">CONFIRMAR</button>
    </div>

    <div id="overlay" class="overlay hidden"></div>
    <div id="parabens" class="feedback-modal hidden">
      <h2>PARABÉNS!<br>VOCÊ ACERTOU</h2>
      <img src="imgs/respostaCerta.png" alt="Parabéns" /> <br>
      <a href="jogoIntQuimica2.php"><button class="feedback-button">PRÓXIMO</button></a>
    </div>
    
    <div id="erro" class="feedback-modal hidden">
      <h2>VAMOS TENTAR<br>NOVAMENTE</h2>
      <img src="imgs/respostaIncorreta.png" alt="Erro" /> <br>
      <button class="feedback-button" onclick="tentarNovamente()">TENTE NOVAMENTE</button>
    </div>
  </div>

  <script src="js/jogoIntQuimica.js"></script>
</body>

</html>