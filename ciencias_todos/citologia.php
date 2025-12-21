<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citologia</title>
    <link rel="stylesheet" href="css/citologia.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="citologia-content">
        <div class="container">
            <h1>Citologia</h1>

            <section id="intro" class="section">
                <h2>Citologia</h2>
                <p>A citologia é a parte da biologia onde estudamos as células!</p>
                <div class="highlight">Na teoria celular definimos: Todo ser vivo tem células;</div>

                <div class="two-column">
                    <div class="column">
                        <div class="cell-type">Unicelular:</div>
                        <img src="imgs/procarionte.png" alt="Bactéria unicelular"
                            style="display: block; margin: 0 auto; max-width: 100%;">
                        <p>Possuem uma célula<br>Exemplo: Todas as Bactérias, todos os Protozoários e alguns fungos e algumas algas</p>
                    </div>
                    <div class="column">
                        <div class="cell-type">Multicelular:</div>
                        <img src="imgs/eucarionte.png" alt="Seres multicelulares"
                            style="display: block; margin: 0 auto; max-width: 100%;">
                        <p>Possuem mais de uma célula<br>Exemplo: Alguns fungos, algumas algas, todas as plantas e todos os animais</p>
                    </div>
                </div>
            </section>
            <section id="procariontes" class="section">
                <h2>Procariontes</h2>
                <p>São células que não possuem <strong>Carioteca</strong>e o DNA fica espalhado no citoplasma</p>

                <div class="highlight">
                    <p>Mas o que é Carioteca?</p>
                    <p>Ela <strong>protege o núcleo</strong> e também tem portinhas especiais que deixam entrar e sair
                      só o que é permitido — como se fossem guardinhas do castelo!</p>
                </div>

                <p><strong>Exemplos</strong></p>
                <p>Somente as bactérias</p>

                <img src="imgs/procarionte.png" alt="Bactéria procarionte"
                    style="display: block; margin: 20px auto; max-width: 100%;">
            </section>
            <section id="eucariontes" class="section">
                <h2>Eucariontes</h2>
                <p>São células que possuem <strong>Carioteca</strong> - DNA fica guardado no núcleo</p>
                <p>Existem dois tipos de célula eucarionte:</p>

                <div class="two-column">
                    <div class="column">
                        <div class="cell-type">Animais</div>
                        <img src="imgs/celulaAnimal.png" alt="Célula Animal"
                            style="display: block; margin: 0 auto; max-width: 100%;">
                    </div>
                    <div class="column">
                        <div class="cell-type">Vegetais</div>
                        <img src="imgs/celulaVegetal.png" alt="Célula Vegetal"
                            style="display: block; margin: 0 auto; max-width: 100%;">
                    </div>
                </div>

                <div class="highlight">
                    <p>Quais são as diferenças entre elas?</p>
                    <p>Só tem na célula animal: centríolo</p>
                    <p>Só tem na célula vegetal: parede celular, vacúolo e cloroplasto</p>
                </div>
            </section>

            <section id="vegetais" class="section">
                <h2>Vegetais</h2>

                <div class="cell-container" id="vegetal-cell-container">
                    <img src="imgs/celulaVegetal.png" alt="Célula Vegetal" class="cell-image">

                    <div class="cell-part" id="vacuolo-veg">Vacúolo</div>
                    <div class="cell-part" id="nucleo-veg">Núcleo</div>
                    <div class="cell-part" id="cloroplasto-veg">Cloroplasto</div>
                    <div class="cell-part" id="reticulo-veg">Retículo Endoplasmático</div>
                    <div class="cell-part" id="citoplasma-veg">Citoplasma</div>
                    <div class="cell-part" id="mitocondria-veg">Mitocôndria</div>
                    <div class="cell-part" id="lisossomo-veg">Lisossomo</div>
                    <div class="cell-part" id="ribossomo-veg">Ribossomo</div>
                    <div class="cell-part" id="parede-veg">Parede Celular</div>
                </div>
            </section>

            <section id="animais" class="section">
                <h2>Animais</h2>

                <div class="cell-container" id="animal-cell-container">
                    <img src="imgs/celulaAnimal.png" alt="Célula Animal" class="cell-image">

                    <div class="cell-part" id="nucleo-ani">Núcleo</div>
                    <div class="cell-part" id="lisossomo-ani">Lisossomo</div>
                    <div class="cell-part" id="ribossomo-ani">Ribossomo</div>
                    <div class="cell-part" id="reticulo-ani">Retículo Endoplasmático</div>
                    <div class="cell-part" id="citoplasma-ani">Citoplasma</div>
                    <div class="cell-part" id="mitocondria-ani">Mitocôndria</div>
                    <div class="cell-part" id="golgi-ani">Complexo de Golgi</div>
                    <div class="cell-part" id="centriolo-ani">Centríolo</div>
                    <div class="cell-part" id="membrana-ani">Membrana Plasmática</div>
                </div>
            </section>

            <div class="exercicio-container">
                <a href="atividadeCitologia.php" class="botao-exercicio"><i class="fas fa-pencil-alt"></i> EXERCÍCIOS</a>
                <a href="jogoCitologia.php" class="botao-exercicio"><i class="fas fa-gamepad"></i> JOGO</a>
            </div>
    </div>

    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h3 id="popup-title">Título da Organela</h3>
            <p id="popup-content">Descrição da organela e suas funções.</p>
        </div>
    </div>
    <script src="js/citologia.js"></script>
</body>

</html>