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
    <title>Resultados - Introdução à Química</title>
    <link rel="stylesheet" href="css/resultado_intquimica.css">
    <link rel="icon" type="image/png" href="imgs/favicon.png"></head>
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
                        <h2 class="perfect">🌟 Parabéns! Você é incrível! 🌟</h2>
                        <p>Você demonstrou um conhecimento perfeito sobre os conceitos básicos da química!</p>
                        <p>Continue explorando esse fascinante mundo da ciência! 🧪</p>
                    </div>
                    <div class="feedback-image">
                        <img src="imgs/respostaCerta.png" alt="Feedback Excelente" class="feedback-icon">
                    </div>
                <?php elseif ($porcentagem >= 70): ?>
                    <div class="feedback-content">
                        <h2 class="good">🎉 Muito bom! Você está indo muito bem! 🎉</h2>
                        <p>Você tem um ótimo entendimento dos conceitos básicos da química!</p>
                        <p>Continue estudando para aperfeiçoar ainda mais seus conhecimentos! 💪</p>
                    </div>
                    <div class="feedback-image">
                        <img src="imgs/respostaIncorreta.png" alt="Feedback Muito Bom" class="feedback-icon">
                    </div>
                <?php elseif ($porcentagem >= 50): ?>
                    <div class="feedback-content">
                        <h2 class="average">👍 Bom trabalho! Você está no caminho certo! 👍</h2>
                        <p>Como os átomos que formam moléculas, seu conhecimento está se construindo!</p>
                        <p>Vamos revisar juntos? Com mais estudo, você dominará esse conteúdo! 📚</p>
                    </div>
                    <div class="feedback-image">
                        <img src="imgs/respostaIncorreta.png" alt="Feedback Bom" class="feedback-icon">
                    </div>
                <?php else: ?>
                    <div class="feedback-content">
                        <h2 class="needs-improvement">💫 Você é mais forte do que pensa! 💫</h2>
                        <p>Cada tentativa é um passo para o sucesso. Não desista! 🌈</p>
                        <p>Que tal revisarmos os conceitos básicos da química juntos? 🤝</p>
                    </div>
                    <div class="feedback-image">
                        <img src="imgs/respostaIncorreta.png" alt="Feedback Tente Novamente" class="feedback-icon">
                    </div>
                <?php endif; ?>
            </div>

            <div class="button-container">
                <a href="atividadeIntQuimica.php" class="btn btn-retry">Tentar Novamente 🔄</a>
                <a href="intQuimica.php" class="btn btn-study">Revisar Conteúdo 📚</a>
            </div>
        </div>
    </div>
</body>
</html> 