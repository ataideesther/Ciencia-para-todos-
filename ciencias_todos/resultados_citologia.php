<?php
include_once('menu.php');

// Receber os parâmetros da URL
$pontuacao = isset($_GET['pontuacao']) ? intval($_GET['pontuacao']) : 0;
$total = isset($_GET['total']) ? intval($_GET['total']) : 0;

// Calcular a porcentagem de acertos
$porcentagem = $total > 0 ? ($pontuacao / $total) * 100 : 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados - Citologia</title>
    <link rel="stylesheet" href="css/resultados_citologia.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="results-card">
            <h1>Resultados da Atividade</h1>
            
            <div class="score-container">
                <div class="score-circle">
                    <div class="score-number"><?php echo $pontuacao; ?></div>
                    <div class="score-label">acertos</div>
                </div>
                <div class="score-details">
                    <p>Total de questões: <strong><?php echo $total; ?></strong></p>
                    <p>Porcentagem de acertos: <strong><?php echo number_format($porcentagem, 1); ?>%</strong></p>
                </div>
            </div>

            <div class="feedback-message">
                <?php if ($porcentagem == 100): ?>
                    <div class="feedback-content">
                        <h2 class="perfect">🌟 Incrível! Você é um verdadeiro cientista! 🌟</h2>
                        <p>Você acertou todas as questões! Seu cérebro é como uma célula super poderosa! 🧬✨</p>
                        <p>Continue assim, você tem um talento especial para a ciência! 🔬</p>
                    </div>
                    <div class="feedback-image">
                        <img src="imgs/respostaCerta.png" alt="Resposta Correta" class="feedback-icon">
                    </div>
                <?php elseif ($porcentagem >= 70): ?>
                    <div class="feedback-content">
                        <h2 class="good">🌟 Que show! Você foi muito bem! 🌟</h2>
                        <p>Você está aprendendo muito sobre as células! 🦠</p>
                        <p>Cada erro é uma nova chance de aprender. Você é capaz! 💪</p>
                    </div>
                    <div class="feedback-image">
                        <img src="imgs/respostaCerta.png" alt="Resposta Correta" class="feedback-icon">
                    </div>
                <?php elseif ($porcentagem >= 50): ?>
                    <div class="feedback-content">
                        <h2 class="average">⭐ Você está no caminho certo! ⭐</h2>
                        <p>Como uma célula em crescimento, você está evoluindo! 🌱</p>
                        <p>Vamos revisar juntos? Você consegue melhorar ainda mais! 📚</p>
                    </div>
                    <div class="feedback-image">
                        <img src="imgs/respostaIncorreta.png" alt="Resposta Parcialmente Correta" class="feedback-icon">
                    </div>
                <?php else: ?>
                    <div class="feedback-content">
                        <h2 class="needs-improvement">💫 Você é mais forte do que pensa! 💫</h2>
                        <p>Cada tentativa é um passo para o sucesso. Não desista! 🌈</p>
                        <p>Que tal tentarmos novamente? Juntos, vamos descobrir mais sobre as células! 🤝</p>
                    </div>
                    <div class="feedback-image">
                        <img src="imgs/respostaIncorreta.png" alt="Resposta Incorreta" class="feedback-icon">
                    </div>
                <?php endif; ?>
            </div>

            <div class="button-container">
                <a href="atividadeCitologia.php" class="btn btn-retry">Tentar Novamente 🔄</a>
                <a href="citologia.php" class="btn btn-study">Revisar Conteúdo 📚</a>
            </div>
        </div>
    </div>
</body>
</html> 