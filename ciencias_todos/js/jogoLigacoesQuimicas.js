const cardsData = [
  { type: 'text', content: 'Iônica', pairId: 1 },
  { type: 'img', src: 'imgs/ligacaoIonica.png', pairId: 1 },
  { type: 'text', content: 'Covalente', pairId: 2 },
  { type: 'img', src: 'imgs/ligacaoCovalente.png', pairId: 2 },
  { type: 'text', content: 'Metálica', pairId: 3 },
  { type: 'img', src: 'imgs/ligacaoMetalica.png', pairId: 3 },
];

// Variáveis do jogo
const cards = [...cardsData];
const board = document.getElementById('game-board');
const moveCounter = document.getElementById('move-counter').querySelector('span');
const timerElement = document.getElementById('timer').querySelector('span');
const message = document.getElementById('message');
const pauseScreen = document.getElementById('pause-screen');
const finalMoves = document.getElementById('final-moves');
const finalTime = document.getElementById('final-time');
const restartBtn = document.getElementById('restart-btn');
const pauseBtn = document.getElementById('pause-btn');
const resumeBtn = document.getElementById('resume-btn');

let firstCard = null;
let secondCard = null;
let lockBoard = false;
let moves = 0;
let matches = 0;
let timerInterval = null;
let seconds = 0;
let minutes = 0;
let isPaused = false;
const totalMatches = cardsData.length / 2; // 3 pares

// Inicializa o jogo
initGame();

// Função para inicializar o jogo
function initGame() {
  resetVariables();
  shuffleCards();
  createBoard();
  startTimer();
}

// Função para resetar variáveis
function resetVariables() {
  firstCard = null;
  secondCard = null;
  lockBoard = false;
  moves = 0;
  matches = 0;
  seconds = 0;
  minutes = 0;
  isPaused = false;
  moveCounter.textContent = '0';
  timerElement.textContent = '00:00';
  clearInterval(timerInterval);
  
  // Limpa o tabuleiro anterior se existir
  while (board.firstChild) {
    board.removeChild(board.firstChild);
  }
  
  // Esconde as mensagens
  message.classList.remove('show');
  pauseScreen.classList.remove('show');
  
  // Reseta o botão de pausa
  pauseBtn.innerHTML = '<i class="fas fa-pause"></i> Pausar';
  pauseBtn.classList.remove('playing');
}

// Função para embaralhar cards
function shuffleCards() {
  cards.sort(() => 0.5 - Math.random());
}

// Função para iniciar o timer
function startTimer() {
  clearInterval(timerInterval);
  timerInterval = setInterval(() => {
    seconds++;
    if(seconds >= 60) {
      minutes++;
      seconds = 0;
    }
    updateTimerDisplay();
  }, 1000);
}

// Função para atualizar a exibição do timer
function updateTimerDisplay() {
  const formattedMinutes = minutes.toString().padStart(2, '0');
  const formattedSeconds = seconds.toString().padStart(2, '0');
  timerElement.textContent = `${formattedMinutes}:${formattedSeconds}`;
}

// Função para criar os cards
function createBoard() {
  cards.forEach(cardData => {
    const card = document.createElement('div');
    card.classList.add('card');
    card.dataset.pairId = cardData.pairId;
  
    const cardInner = document.createElement('div');
    cardInner.classList.add('card-inner');
  
    const cardFront = document.createElement('div');
    cardFront.classList.add('card-front');
  
    const cardBack = document.createElement('div');
    cardBack.classList.add('card-back');
  
    if (cardData.type === 'text') {
      cardBack.textContent = cardData.content;
    } else if (cardData.type === 'img') {
      const img = document.createElement('img');
      img.src = cardData.src;
      img.alt = 'Ligação química';
      cardBack.appendChild(img);
    }
  
    cardInner.appendChild(cardFront);
    cardInner.appendChild(cardBack);
    card.appendChild(cardInner);
  
    card.addEventListener('click', flipCard);
    board.appendChild(card);
  });
}

// Função para virar o card
function flipCard() {
  if (lockBoard || this.classList.contains('flipped') || isPaused) return;
  
  this.classList.add('flipped');
  
  if (!firstCard) {
    firstCard = this;
  } else {
    secondCard = this;
    lockBoard = true;
    
    // Incrementa o contador de movimentos
    moves++;
    moveCounter.textContent = moves;
    
    // Verifica se é um par
    checkForMatch();
  }
}

// Função para verificar se é um par
function checkForMatch() {
  const isMatch = firstCard.dataset.pairId === secondCard.dataset.pairId;
  
  if (isMatch) {
    // É um par!
    disableCards();
    matches++;
    
    // Verifica se o jogo acabou
    if (matches === totalMatches) {
      endGame();
    }
  } else {
    // Não é um par
    unflipCards();
    
    // Adiciona animação de erro
    firstCard.classList.add('wrong-match');
    secondCard.classList.add('wrong-match');
  }
}

// Função para desabilitar os cards quando acertam o par
function disableCards() {
  firstCard.classList.add('match');
  secondCard.classList.add('match');
  
  firstCard.removeEventListener('click', flipCard);
  secondCard.removeEventListener('click', flipCard);
  
  resetBoard();
}

// Função para desvirar os cards quando erram o par
function unflipCards() {
  setTimeout(() => {
    firstCard.classList.remove('flipped');
    secondCard.classList.remove('flipped');
    
    // Remove a classe de animação de erro
    setTimeout(() => {
      firstCard.classList.remove('wrong-match');
      secondCard.classList.remove('wrong-match');
    }, 400);
    
    resetBoard();
  }, 1000);
}

// Função para resetar o board para a próxima jogada
function resetBoard() {
  [firstCard, secondCard] = [null, null];
  lockBoard = false;
}

// Função para finalizar o jogo
function endGame() {
  clearInterval(timerInterval);
  
  // Atualiza estatísticas finais
  finalMoves.textContent = moves;
  finalTime.textContent = timerElement.textContent;
  
  // Mostra mensagem de vitória com efeito de atraso
  setTimeout(() => {
    message.classList.add('show');
  }, 500);
}

// Função para pausar o jogo
function togglePause() {
  isPaused = !isPaused;
  
  if (isPaused) {
    // Pause o jogo
    clearInterval(timerInterval);
    pauseScreen.classList.add('show');
    lockBoard = true;
    pauseBtn.innerHTML = '<i class="fas fa-play"></i> Continuar';
    pauseBtn.classList.add('playing');
  } else {
    // Continue o jogo
    startTimer();
    pauseScreen.classList.remove('show');
    lockBoard = false;
    pauseBtn.innerHTML = '<i class="fas fa-pause"></i> Pausar';
    pauseBtn.classList.remove('playing');
  }
}

// Event listeners
restartBtn.addEventListener('click', initGame);
pauseBtn.addEventListener('click', togglePause);
resumeBtn.addEventListener('click', togglePause);