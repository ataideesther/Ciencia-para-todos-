<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ligações Químicas</title>
  <link rel="stylesheet" href="css/ligacoesQuimicas.css" />
  <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
  <?php
  include_once('menu.php');
  ?>
  <section class="quimica">
    <h1>LIGAÇÕES QUÍMICAS</h1>
    <div class="conteudo">
      <div class="imagem">
        <img src="imgs/distribuicaoEletronicaOxigenio.png" alt="Átomo de Oxigênio" />
        <p>Átomo de Oxigênio</p>
      </div>
      <div class="texto">
        <p><strong>Todo elemento na natureza busca estabilidade.</strong></p>
        <p>Para conseguir, ele segue a regra do Octeto, 8 elétrons na camada de valência.</p>

        <p>Vamos analisar o átomo de oxigênio?</p>

        <p>O oxigênio possui 8 elétrons ao todo sendo:</p>
        <ul>
          <li>2 elétrons na primeira camada;</li>
          <li>6 na segunda camada.</li>
        </ul>

        <p>Como ele é um não metal, ele precisa<br>
          receber 2 elétrons para ficar estável.</p>

        <p>Entendeu?<br>
          Vamos conferir os tipos de ligações abaixo</p>
      </div>
    </div>
  </section>

  <section class="tipos-ligacoes">
    <div class="ligacao">
      <h2>Ligação Iônica</h2>
      <p>Ocorre entre metais e ametais.</p>
      <img src="imgs/ligacaoIonica.png" alt="Ligação Iônica">
      <p>Neste exemplo, o átomo de Sódio(Na) doa 1 elétrom para o átomo de Cloro(Cl)</p> <br>
      <p>Um átomo doa e o outro recebe elétrons, formando íons.</p>
      <img src="imgs/ionica.jpg" alt="Ligação Iônica">
    </div>

    <div class="ligacao">
      <h2>Ligação Covalente</h2>
      <p>Acontece entre ametais.</p>
      <img src="imgs/ligacaoCovalente.png" alt="Ligação Covalente">
      <p>Neste exemplo, os átomos de Oxigênio(O) e Hidrogênio(H) estão <strong>compartilhando</strong> 2 elétrons</p>
      <p>Os átomos compartilham pares de elétrons.</p>
      <img src="imgs/covalente.jpg" alt="Ligação Covalente">
    </div>

    <div class="ligacao">
      <h2>Ligação Metálica</h2>
      <p>Ocorre entre metais. </p>
      <img src="imgs/ligacaoMetalica.png" alt="Ligação Metálica">
      <p>Os elétrons ficam livres, formando um "mar de elétrons".</p>
      <img src="imgs/metalica.jpg" alt="Ligação Metálica">
    </div>

  </section>
  <div class="exercicio-container">
    <a href="atividadeLigacoesQuimicas.php" class="botao-exercicio"><i class="fas fa-pencil-alt"></i> EXERCÍCIOS</a>
    <a href="jogoLigacoesQuimicas.php" class="botao-exercicio"><i class="fas fa-gamepad"></i> JOGO</a>
  </div>
</body>

</html>