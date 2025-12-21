<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modelos Atômicos</title>
  <link rel="stylesheet" href="css/jogoModelosAtomicos.css">
  <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body>
  <?php
  include_once('menu.php');
  ?>
  <header>Modelos Atômicos</header> 
  <br>
  <div class="content">
    <p class="subtitulo">Organize os autores de cada modelo e seus apelidos</p>

    <div class="modelos-container">
      <div class="modelo" data-correto="Dalton|bola de bilhar">
        <img src="imgs/dalton.png" alt="Modelo Dalton">
        <div class="dropzone" data-type="autor"></div>
        <div class="dropzone" data-type="apelido"></div>
      </div>

      <div class="modelo" data-correto="Thomson|Pudim de passas">
        <img src="imgs/thomson.png" alt="Modelo Thomson">
        <div class="dropzone" data-type="autor"></div>
        <div class="dropzone" data-type="apelido"></div>
      </div>

      <div class="modelo" data-correto="Rutherford|Planetário">
        <img src="imgs/rutherford.png" alt="Modelo Rutherford">
        <div class="dropzone" data-type="autor"></div>
        <div class="dropzone" data-type="apelido"></div>
      </div>

      <div class="modelo" data-correto="Bohr|Órbitas estacionarias">
        <img src="imgs/bohr.png" alt="Modelo Bohr">
        <div class="dropzone" data-type="autor"></div>
        <div class="dropzone" data-type="apelido"></div>
      </div>
    </div>

    <div id="opcoes">
      <div class="linha-opcoes">
        <div class="draggable" draggable="true">Dalton</div>
        <div class="draggable" draggable="true">Thomson</div>
        <div class="draggable" draggable="true">Rutherford</div>
        <div class="draggable" draggable="true">Bohr</div>
      </div>
      <div class="linha-opcoes">
        <div class="draggable" draggable="true">bola de bilhar</div>
        <div class="draggable" draggable="true">Pudim de passas</div>
        <div class="draggable" draggable="true">Planetário</div>
        <div class="draggable" draggable="true">Órbitas estacionarias</div>
      </div>
    </div>
  </div>
 
  <button class="btn-confirmar" onclick="verificar()">CONFIRMAR</button>

  <div id="overlay" class="overlay hidden"></div>

  <div id="parabens" class="feedback-modal-certo hidden">
    <h2>PARABÉNS!<br>VOCÊ ACERTOU</h2>
    <img src="imgs/respostaCerta.png" alt="Parabéns" /> <br>
    <a href="atividademodelosatomicos.php"><button class="feedback-button">PRÓXIMO</button></a>
  </div>

  <div id="erro" class="feedback-modal-erro hidden">
    <h2>VAMOS TENTAR<br>NOVAMENTE</h2>
    <img src="imgs/respostaIncorreta.png" alt="Erro" /> <br>
    <button class="feedback-button" onclick="tentarNovamente()">TENTE NOVAMENTE</button>
  </div>

  <script src="js/jogoModelosAtomicos.js"></script>
</body>

</html>