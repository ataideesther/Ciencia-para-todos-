<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/jogoLigacoesQuimicas.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/jogoLigacoesQuimicas.css">
    <title>Ligações Químicas</title>
</head>
<body>
    <div class="container">
        <?php
        include_once('menu.php');
        ?>
        <header>
            <div class="header-content">
                <h1><i class="fas fa-atom"></i> Ligações Químicas</h1>
            </div>
        </header>
        
        <main class="jogo-container">
            <div class="jogo-header">
                <h2>Encontre os pares das Ligações Químicas</h2>
                <div class="stats-container">
                    <div id="move-counter" class="stat-box">
                        <i class="fas fa-arrows-rotate"></i> Movimentos: <span>0</span>
                    </div>
                    <div id="timer" class="stat-box">
                        <i class="fas fa-clock"></i> Tempo: <span>00:00</span>
                    </div>
                    <button id="pause-btn" class="pause-btn">
                        <i class="fas fa-pause"></i> Pausar
                    </button>
                </div>
            </div>
            
            <div class="board-container">
                <div id="game-board"></div>
            </div>
            
            <div id="message" class="message-box">
                <div class="message-content">
                    <p>🎉 Parabéns! Você completou o jogo! 🎉</p>
                    <div class="stats-final">
                        <p>Movimentos: <span id="final-moves">0</span></p>
                        <p>Tempo: <span id="final-time">00:00</span></p>
                    </div>
                    <button id="restart-btn" class="restart-btn">Jogar novamente</button>
                    <br>
                    <br>
                    <a href="atividadeLigacoesQuimicas.php" class="feedback-button">PRÓXIMO</a>
                </div>
            </div>
            
            <div id="pause-screen" class="message-box">
                <div class="message-content">
                    <p><i class="fas fa-pause-circle"></i> Jogo Pausado</p>
                    <button id="resume-btn" class="restart-btn">Continuar</button>
                </div>
            </div>
        </main>
    </div>
    
    <script src="js/jogoLigacoesQuimicas.js"></script>
</body>
</html>