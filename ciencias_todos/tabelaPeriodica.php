<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/tabelaPeriodica.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <title>Tabela Periódica</title>
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="titulo">
        <h1>Tabela Periódica</h1>
    </div>
    <div class="info boxes">
        <div class="explicacao1">
            <p>A Tabela Periódica é uma <strong>forma organizada de apresentar os elementos químicos</strong>, facilitando o estudo
                de suas propriedades e relações.Ela é dividida em grupos e períodos, e os elementos são organizados em ordem crescente de número
                atômico. </p>
        </div>

    </div>
    <h2>Principais Elementos e seus Usos</h2>
    <div class="elementos-principais">

        <!-- Hidrogênio (1) -->
        <div class="elemento">
            <h3 class="titulo-elemento">Hidrogênio</h3>
            <div class="icone">
                <img src="imgs/hidrogenio.png" alt="Hidrogênio">
            </div>
            <p class="descricao-principal">Elemento mais simples e mais abundante do universo.</p>
            <p class="descricao-secundaria">O sol é feito de Hidrogênio</p>
            <div class="exemplo">
                <img src="imgs/sol.png" alt="Sol">
            </div>
        </div>

        <!-- Lítio (3) -->
        <div class="elemento">
            <h3 class="titulo-elemento">Lítio</h3>
            <div class="icone">
                <img src="imgs/litio.png" alt="Lítio">
            </div>
            <div class="descricao">
                <p class="descricao-principal">Metal mais leve da tabela periódica, é altamente reativo.</p>
                <p class="descricao-secundaria">Presente nas baterias.</p>
            </div>
            <div class="exemplo">
                <img src="imgs/bateria.png" alt="Bateria de Lítio">
            </div>
        </div>

        <!-- Carbono (6) -->
        <div class="elemento">
            <div class="icone">
                <h3 class="titulo-elemento">Carbono</h3>
                <img src="imgs/carbono.png" alt="Carbono">
            </div>
            <div class="descricao">
                <p class="descricao-principal">Base da vida, presente em compostos orgânicos.</p>
                <p class="descricao-secundaria">Usado em lápis e componentes eletrônicos.</p>
            </div>
            <div class="exemplo">
                <img src="imgs/diamante.png" alt="Lápis de Carbono">
            </div>
        </div>

        <!-- Nitrogênio (7) -->
        <div class="elemento">
            <h3 class="titulo-elemento">Nitrogênio</h3>
            <div class="icone">
                <img src="imgs/nitrogenio.png" alt="Nitrogênio">
            </div>
            <p class="descricao-principal">Elemento que constitui o gás mais abundante na atmosfera.</p>
            <p class="descricao-secundaria">Os fertilizantes possuem nitrogênio</p>
            <div class="exemplo">
                <img src="imgs/fertilizante.png" alt="Fertilizante">
            </div>
        </div>

        <!-- Oxigênio (8) -->
        <div class="elemento">
            <h3 class="titulo-elemento">Oxigênio</h3>
            <div class="icone">
                <img src="imgs/oxigenio.png" alt="Oxigênio">
            </div>
            <div class="descricao">
                <p class="descricao-principal">Fundamental para a respiração dos seres vivos.</p>
                <p class="descricao-secundaria">Utilizado em hospitais e mergulho.</p>
            </div>
            <div class="exemplo">
                <img src="imgs/tubo-oxigenio.png" alt="Máscara de Oxigênio">
            </div>
        </div>

        <!-- Alumínio (13) -->
        <div class="elemento">
            <h3 class="titulo-elemento">Alumínio</h3>
            <div class="icone">
                <img src="imgs/aluminio.png" alt="Alumínio">
            </div>
            <p class="descricao-principal">Metal mais abundante na crosta terrestre.</p>
            <p class="descricao-secundaria">As latinhas de refrigerante têm alumínio</p>
            <div class="exemplo">
                <img src="imgs/lata.png" alt="Lata de Refrigerante">
            </div>
        </div>

        <!-- Fósforo (15) -->
        <div class="elemento">
            <h3 class="titulo-elemento">Fósforo</h3>
            <div class="icone">
                <img src="imgs/fosforo.png" alt="Fósforo">
            </div>
            <p class="descricao-principal">Um dos componentes das biomoléculas.</p>
            <p class="descricao-secundaria">O fósforo está presente na ATP da respiração celular.</p>
            <div class="exemplo">
                <img src="imgs/atp.png" alt="Adenosina Trifosfata (ATP)">
            </div>
        </div>

        <!-- Ferro (26) -->
        <div class="elemento">
            <div class="icone">
                <h3 class="titulo-elemento">Ferro</h3>
                <img src="imgs/ferro.png" alt="Ferro">
            </div>
            <div class="descricao">
                <p class="descricao-principal">Essencial na produção de aço e estruturas metálicas.</p>
                <p class="descricao-secundaria">Utilizado em construções e ferramentas.</p>
            </div>
            <div class="exemplo">
                <img src="imgs/fusca.png" alt="Estrutura de Construção">
            </div>
        </div>

        <!-- Prata (47) -->
        <div class="elemento">
            <h3 class="titulo-elemento">Prata</h3>
            <div class="icone">
                <img src="imgs/prata.png" alt="Prata">
            </div>
            <p class="descricao-principal">Metal precioso com diversas aplicações.</p>
            <p class="descricao-secundaria">Está presente nas joias.</p>
            <div class="exemplo">
                <img src="imgs/anel.png" alt="Anéis de Prata">
            </div>
        </div>

        <!-- Ouro (79) -->
        <div class="elemento">
            <h3 class="titulo-elemento">Ouro</h3>
            <div class="icone">
                <img src="imgs/ouro.png" alt="Ouro">
            </div>
            <p class="descricao-principal">Metal mais nobre da tabela</p>
            <p class="descricao-secundaria">As moedas de ouro são um dos formatos do ouro</p>
            <div class="exemplo">
                <img src="imgs/moedas.png" alt="Moedas de Ouro">
            </div>
        </div>

        <!-- Mercúrio (80) -->
        <div class="elemento">
            <h3 class="titulo-elemento">Mercúrio</h3>
            <div class="icone">
                <img src="imgs/mercurio.png" alt="Mercúrio">
            </div>
            <p class="descricao-principal">Metal líquido à temperatura ambiente.</p>
            <p class="descricao-secundaria">Está presente nos termômetros</p>
            <div class="exemplo">
                <img src="imgs/termometro.png" alt="Termômetro">
            </div>
        </div>

        <!-- Urânio (92) -->
        <div class="elemento">
            <h3 class="titulo-elemento">Urânio</h3>
            <div class="icone">
                <img src="imgs/uranio.png" alt="Urânio">
            </div>
            <p class="descricao-principal">Último elemento natural da tabela periódica.</p>
            <p class="descricao-secundaria">Está presente nas bombas nucleares</p>
            <div class="exemplo">
                <img src="imgs/bombas.png" alt="Bombas atômicas">
            </div>
        </div>
    </div>

    <div class="exercicio-container">
        <a href="jogoTabelaPeriodica.php" class="botao-exercicio"><i class="fas fa-gamepad"></i> JOGO</a>
    </div>

</body>

</html>