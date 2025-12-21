<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade de Modelos Atômicos</title>
    <link rel="stylesheet" href="css/atividademodelosatomicos.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php include_once('menu.php'); ?>
    <div class="container">
        <header>
            <h1 id="quiz-title">Carregando...</h1>
        </header>

        <div class="progress-container" id="progress-container">
            <!-- Indicadores de questões serão adicionados dinamicamente -->
        </div>

        <div class="quiz-container">
            <div class="question" id="question-text">
                Carregando questão...
            </div>

            <div class="options" id="options-container">
                <!-- Opções serão adicionadas dinamicamente -->
            </div>

            <div class="feedback" id="feedback"></div>

            <div class="button-container">
                <button class="btn btn-secondary" id="prev-btn" disabled>Anterior</button>
                <button class="btn btn-secondary" id="next-btn" disabled>Próxima</button>
            </div>

            <div class="finish-container">
                <button class="btn btn-primary" id="finish-btn" style="display: none;">Finalizar Atividade</button>
            </div>
        </div>
    </div>
    
    <div class="result-section" id="results" style="display: none;">
        <h2>Resultado do Quiz</h2>
        <p>Você acertou <span id="score">0</span> de <span id="total-questions">0</span> questões!</p>
        <div id="resultMessage"></div>
        <button class="btn btn-primary" id="restart-btn">Tentar Novamente</button>
    </div>
    <script>
        // Adicione esta variável no início do seu JavaScript
        const idAluno = <?php echo $id_aluno; ?>;
    </script>
    <script src="js/atividademodelosatomicos.js"></script>
</body>

</html>