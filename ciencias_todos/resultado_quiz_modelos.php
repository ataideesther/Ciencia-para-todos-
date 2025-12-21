<?php
include_once('menu.php');

// Receber os parâmetros da URL
$pontuacao = isset($_GET['pontuacao']) ? intval($_GET['pontuacao']) : 0;
$total = isset($_GET['total']) ? intval($_GET['total']) : 0;

// Conectar ao banco de dados
$conn = new PDO("mysql:host=localhost;dbname=cienciadb", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ID fixo para a trilha de Modelos Atômicos
$id_trilha = 2;

// Buscar o número de acertos do aluno
$stmt = $conn->prepare("
    SELECT COUNT(*) as total_acertos
    FROM resposta r
    JOIN questao q ON r.id_questao = q.id_questao
    WHERE r.id_aluno = :id_aluno
    AND r.id_trilha = :id_trilha
    AND TRIM(r.resposta_dada) = TRIM(q.alternativa_correta)
");

$stmt->execute([
    ':id_aluno' => $_SESSION['id'],
    ':id_trilha' => $id_trilha
]);

$result = $stmt->fetch(PDO::FETCH_ASSOC);
$pontuacao = $result['total_acertos'];

// Buscar o total de questões da trilha
$stmt = $conn->prepare("
    SELECT COUNT(*) as total_questoes
    FROM questao
    WHERE id_trilha = :id_trilha
");

$stmt->execute([':id_trilha' => $id_trilha]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total = $result['total_questoes'];

// Calcular a porcentagem de acertos
$porcentagem = $total > 0 ? ($pontuacao / $total) * 100 : 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados - Modelos Atômicos</title>
    <link rel="stylesheet" href="css/resultado_quiz_modelos.css">
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
                        <h2 class="perfect">🌟 Incrível! Você é um verdadeiro cientista atômico! 🌟</h2>
                        <p>Você acertou todas as questões! Seu conhecimento sobre os modelos atômicos é excepcional! ⚛️✨</p>
                        <p>Continue assim, você tem um talento especial para a física! 🔬</p>
                    </div>
                    <div class="feedback-image">
                        <img src="imgs/respostaCerta.png" alt="Resposta Correta" class="feedback-icon">
                    </div>
                <?php elseif ($porcentagem >= 70): ?>
                    <div class="feedback-content">
                        <h2 class="good">🌟 Que show! Você foi muito bem! 🌟</h2>
                        <p>Você está dominando os modelos atômicos! ⚛️</p>
                        <p>Cada erro é uma nova chance de aprender. Você está no caminho certo! 💪</p>
                    </div>
                    <div class="feedback-image">
                        <img src="imgs/respostaCerta.png" alt="Resposta Correta" class="feedback-icon">
                    </div>
                <?php elseif ($porcentagem >= 50): ?>
                    <div class="feedback-content">
                        <h2 class="average">⭐ Você está no caminho certo! ⭐</h2>
                        <p>Como um elétron em movimento, você está evoluindo! 🌱</p>
                        <p>Vamos revisar juntos? Você consegue melhorar ainda mais! 📚</p>
                    </div>
                    <div class="feedback-image">
                        <img src="imgs/respostaIncorreta.png" alt="Resposta Parcialmente Correta" class="feedback-icon">
                    </div>
                <?php else: ?>
                    <div class="feedback-content">
                        <h2 class="needs-improvement">💫 Você é mais forte do que pensa! 💫</h2>
                        <p>Cada tentativa é um passo para o sucesso. Não desista! 🌈</p>
                        <p>Que tal tentarmos novamente? Juntos, vamos descobrir mais sobre os modelos atômicos! 🤝</p>
                    </div>
                    <div class="feedback-image">
                        <img src="imgs/respostaIncorreta.png" alt="Resposta Incorreta" class="feedback-icon">
                    </div>
                <?php endif; ?>
            </div>

            <div class="button-container">
                <a href="atividadeModelosAtomicos.php" class="btn btn-retry">Tentar Novamente 🔄</a>
                <a href="modelosatomicos.php" class="btn btn-study">Revisar Conteúdo 📚</a>
            </div>
        </div>
    </div>
</body>
</html>