<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Introdução à Química</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="css/jogoIntQuimica2.css">
  <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>
<body>
  <?php include_once('menu.php'); ?>
  
  <header>Introdução à Química</header>
  
  <div class="container">
    <div class="instructions">
      <h3>Classificação da Matéria</h3>
      <p>Arraste os conceitos corretos para cada imagem para aprender sobre a classificação da matéria.</p>
    </div>

    <div class="atom-animation">
      <div class="atom-orbit"></div>
      <div class="atom-orbit"></div>
      <div class="atom-orbit"></div>
    </div>

    <div class="game-area">
      <div class="images-grid">
        <div class="img-card">
          <img src="imgs/substanciaSimples.png" alt="H2" class="chemistry-img" />
          <div class="drop-box" data-index="0" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        </div>
        
        <div class="img-card">
          <img src="imgs/misturaHomogenea.png" alt="Grade Atômica" class="chemistry-img" />
          <div class="drop-box" data-index="1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        </div>
        
        <div class="img-card">
          <img src="imgs/misturaHeterogenea.png" alt="Copo com mistura" class="chemistry-img" />
          <div class="drop-box" data-index="2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        </div>
        
        <div class="img-card">
          <img src="imgs/substanciaComposta.png" alt="H2O" class="chemistry-img" />
          <div class="drop-box" data-index="3" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        </div>
      </div>

      <div class="labels">
        <p>Arraste o conceito para o desenho:</p>
        <div class="progress-container">
          <div class="progress-bar" id="progressBar"></div>
          <div class="progress-text">0/4 conceitos posicionados</div>
        </div>
        
        <div id="label1" class="draggable" draggable="true" ondragstart="drag(event)">Substância Pura</div>
        <div class="concept-tip" id="tip1">Substância formada por apenas um tipo de elemento químico.</div>
        
        <div id="label2" class="draggable" draggable="true" ondragstart="drag(event)">Substância Composta</div>
        <div class="concept-tip" id="tip2">Substância formada por dois ou mais elementos químicos combinados.</div>
        
        <div id="label3" class="draggable" draggable="true" ondragstart="drag(event)">Mistura Homogênea</div>
        <div class="concept-tip" id="tip3">Mistura com composição uniforme em toda sua extensão.</div>
        
        <div id="label4" class="draggable" draggable="true" ondragstart="drag(event)">Mistura Heterogênea</div>
        <div class="concept-tip" id="tip4">Mistura onde é possível distinguir seus componentes a olho nu.</div>

        <button class="confirm-button" onclick="checkAnswers()">CONFIRMAR</button>
      </div>
    </div>
  </div>

  <div id="overlay" class="overlay hidden"></div>
<div id="parabens" class="feedback-modal hidden">
    <h2>PARABÉNS!<br>VOCÊ ACERTOU</h2>
    <img src="imgs/respostaCerta.png" alt="Parabéns" /> <br>
    <a href="atividadeintquimica.php" class="feedback-button">PRÓXIMO</a>
</div>
  
  <div id="erro" class="feedback-modal hidden">
    <h2>VAMOS TENTAR<br>NOVAMENTE</h2>
    <img src="imgs/respostaIncorreta.png" alt="Erro" /> <br>
    <button class="feedback-button" onclick="tentarNovamente()">TENTE NOVAMENTE</button>
  </div>

  <script src="js/jogoIntQuimica2.js"></script>
</body>
</html>