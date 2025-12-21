let currentQuestionIndex = 0;
let questions = [];
let userAnswers = [];
let selectedOption = null;

// Elementos do DOM
const quizTitle = document.getElementById('quiz-title');
const questionText = document.getElementById('question-text');
const optionsContainer = document.getElementById('options-container');
const progressContainer = document.getElementById('progress-container');
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
const finishBtn = document.getElementById('finish-btn');
const quizContainer = document.querySelector('.quiz-container');
const resultSection = document.getElementById('results');
const scoreDisplay = document.getElementById('score');
const totalQuestionsDisplay = document.getElementById('total-questions');
const feedbackElement = document.getElementById('feedback');

// Função para buscar questões do servidor
function fetchQuestions() {
    // Mostrar estado de carregamento
    quizTitle.textContent = "Carregando...";
    questionText.textContent = "Por favor, aguarde enquanto carregamos as questões.";

    fetch('get_questions_ecologia.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Falha ao carregar questões');
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.error || 'Erro ao carregar questões');
            }
            processQuestions(data);
        })
        .catch(error => {
            console.error('Erro ao carregar questões:', error);
            quizTitle.textContent = "Erro";
            questionText.textContent = "Não foi possível carregar as questões. Por favor, tente novamente mais tarde.";
            feedbackElement.textContent = error.message;
            feedbackElement.style.display = 'block';
            feedbackElement.style.color = '#dc2626';
        });
}

// Função para processar as questões recebidas
function processQuestions(data) {
    quizTitle.textContent = data.title;
    questions = data.questions;
    totalQuestionsDisplay.textContent = questions.length;

    // Inicializar o array de respostas do usuário
    userAnswers = new Array(questions.length).fill(null);

    // Criar indicadores de progresso
    createProgressIndicators();

    // Carregar a primeira questão
    loadQuestion(0);

    // Mostrar botão finalizar
    updateFinishButton();
}

// Função para criar indicadores de progresso
function createProgressIndicators() {
    progressContainer.innerHTML = '';
    for (let i = 0; i < questions.length; i++) {
        const indicator = document.createElement('div');
        indicator.className = 'question-indicator';
        indicator.textContent = (i + 1).toString();
        
        if (i === currentQuestionIndex) {
            indicator.classList.add('current');
        }
        if (userAnswers[i] !== null) {
            indicator.classList.add('answered');
        }
        
        indicator.addEventListener('click', () => {
            currentQuestionIndex = i;
            loadQuestion(i);
        });
        
        progressContainer.appendChild(indicator);
    }
}

// Função para carregar uma questão
function loadQuestion(index) {
    const question = questions[index];
    questionText.textContent = question.text;
    optionsContainer.innerHTML = '';
    
    question.options.forEach(option => {
        const optionElement = document.createElement('div');
        optionElement.className = 'option';
        if (userAnswers[index] === option.id) {
            optionElement.classList.add('selected');
        }
        optionElement.textContent = `${option.id}) ${option.text}`;
        optionElement.addEventListener('click', () => selectOption(option.id));
        optionsContainer.appendChild(optionElement);
    });
    
    currentQuestionIndex = index;
    updateButtons();
    updateProgressIndicators();
}

// Função para selecionar uma opção
function selectOption(optionId) {
    userAnswers[currentQuestionIndex] = optionId;
    
    const options = optionsContainer.children;
    for (let option of options) {
        option.classList.remove('selected');
        if (option.textContent.startsWith(optionId + ')')) {
            option.classList.add('selected');
        }
    }
    
    updateButtons();
    updateProgressIndicators();
}

// Função para atualizar os botões
function updateButtons() {
    prevBtn.disabled = currentQuestionIndex === 0;
    nextBtn.disabled = currentQuestionIndex === questions.length - 1 || !userAnswers[currentQuestionIndex];
    
    if (currentQuestionIndex === questions.length - 1) {
        nextBtn.style.display = 'none';
        if (userAnswers[currentQuestionIndex] !== null) {
            finishBtn.style.display = 'block';
        }
    } else {
        nextBtn.style.display = 'block';
        finishBtn.style.display = 'none';
    }
}

// Função para atualizar os indicadores de progresso
function updateProgressIndicators() {
    const indicators = progressContainer.children;
    for (let i = 0; i < indicators.length; i++) {
        indicators[i].classList.remove('current', 'answered');
        if (i === currentQuestionIndex) {
            indicators[i].classList.add('current');
        }
        if (userAnswers[i] !== null) {
            indicators[i].classList.add('answered');
        }
    }
}

// Função para atualizar o botão finalizar
function updateFinishButton() {
    const allAnswered = userAnswers.every(answer => answer !== null);
    const isLastQuestion = currentQuestionIndex === questions.length - 1;
    finishBtn.style.display = (isLastQuestion && allAnswered) ? 'block' : 'none';
}

// Função para mostrar resultados
function showResults() {
    // Verificar se todas as questões foram respondidas
    const questoesNaoRespondidas = userAnswers.reduce((acc, resp, idx) => {
        if (resp === null) acc.push(idx + 1);
        return acc;
    }, []);

    if (questoesNaoRespondidas.length > 0) {
        feedbackElement.textContent = `Por favor, responda todas as questões antes de finalizar. Questões não respondidas: ${questoesNaoRespondidas.join(', ')}`;
        feedbackElement.style.display = 'block';
        feedbackElement.style.color = '#dc2626';
        return;
    }

    // Preparar dados para enviar
    const respostasParaEnviar = questions.map((question, index) => ({
        id_questao: parseInt(question.id),
        resposta_dada: userAnswers[index].toString()
    }));

    const dadosEnvio = {
        respostas: respostasParaEnviar,
        total_questoes: questions.length
    };

    // Mostrar loading
    feedbackElement.textContent = "Salvando suas respostas...";
    feedbackElement.style.display = 'block';
    feedbackElement.style.color = '#4884f8';

    // Log para debug
    console.log('Dados sendo enviados:', dadosEnvio);

    fetch('salvar_respostas_ecologia.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ respostas: respostasParaEnviar })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(data.error || 'Erro ao salvar respostas');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Redirecionar para a página de resultados usando a pontuação retornada pelo servidor
            window.location.href = `resultados_ecologia.php?pontuacao=${data.pontuacao}&total=${questions.length}`;
        } else {
            throw new Error(data.error || 'Erro desconhecido ao salvar respostas');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        feedbackElement.textContent = "Erro ao salvar respostas: " + error.message;
        feedbackElement.style.display = 'block';
        feedbackElement.style.color = '#dc2626';
    });
}

// Função para reiniciar o quiz
function restartQuiz() {
    currentQuestionIndex = 0;
    userAnswers = new Array(questions.length).fill(null);
    selectedOption = null;

    quizContainer.style.display = 'block';
    resultSection.style.display = 'none';
    finishBtn.style.display = 'none';
    loadQuestion(0);
}

// Event listeners
prevBtn.addEventListener('click', () => {
    if (currentQuestionIndex > 0) {
        currentQuestionIndex--;
        loadQuestion(currentQuestionIndex);
    }
});

nextBtn.addEventListener('click', () => {
    if (currentQuestionIndex < questions.length - 1) {
        currentQuestionIndex++;
        loadQuestion(currentQuestionIndex);
    }
});

finishBtn.addEventListener('click', showResults);
document.getElementById('restart-btn').addEventListener('click', restartQuiz);

// Iniciar o quiz quando o documento estiver carregado
document.addEventListener('DOMContentLoaded', fetchQuestions); 