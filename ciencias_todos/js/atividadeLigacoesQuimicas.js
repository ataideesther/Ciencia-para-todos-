document.addEventListener('DOMContentLoaded', function () {
    // Verificar se idAluno está definido
    if (typeof idAluno === 'undefined') {
        console.error('ID do aluno não definido');
        window.location.href = 'alunoLogin.php';
        return;
    }

    // Variáveis globais
    let currentQuestionIndex = 0;
    let questions = [];
    let userAnswers = [];
    let selectedOption = null;

    // Elementos DOM
    const questionText = document.getElementById('question-text');
    const optionsContainer = document.getElementById('options-container');
    const progressContainer = document.getElementById('progress-container');
    const quizTitle = document.getElementById('quiz-title');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const finishBtn = document.getElementById('finish-btn');
    const feedbackElement = document.getElementById('feedback');
    const resultSection = document.getElementById('results');
    const scoreDisplay = document.getElementById('score');
    const totalQuestionsDisplay = document.getElementById('total-questions');
    const resultMessage = document.getElementById('resultMessage');
    const restartBtn = document.getElementById('restart-btn');
    const quizContainer = document.querySelector('.quiz-container');

    // Função para buscar questões do servidor
    function fetchQuestions() {
        // Mostrar estado de carregamento
        quizTitle.textContent = "Carregando...";
        questionText.textContent = "Por favor, aguarde enquanto carregamos as questões.";

        fetch('get_questions_ligacoes.php')
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

    // Função para criar os indicadores de progresso
    function createProgressIndicators() {
        progressContainer.innerHTML = '';

        for (let i = 0; i < questions.length; i++) {
            const indicator = document.createElement('div');
            indicator.className = 'question-indicator';
            indicator.textContent = (i + 1).toString();
            indicator.dataset.questionId = questions[i].id;

            if (i === currentQuestionIndex) {
                indicator.classList.add('current');
            }

            // Adicionar evento de clique para navegar para a questão
            indicator.addEventListener('click', () => {
                if (i !== currentQuestionIndex) {
                    currentQuestionIndex = i;
                    loadQuestion(i);
                }
            });

            progressContainer.appendChild(indicator);
        }
    }

    // Função para carregar uma questão
    function loadQuestion(index) {
        // Atualizar a questão atual
        currentQuestionIndex = index;

        // Atualizar indicadores de progresso
        updateProgressIndicators();

        // Obter a questão atual
        const currentQuestion = questions[index];

        // Atualizar texto da questão
        questionText.textContent = currentQuestion.text;

        // Limpar opções anteriores
        optionsContainer.innerHTML = '';

        // Recuperar resposta anterior se existir
        selectedOption = userAnswers[index];

        // Adicionar opções de resposta
        currentQuestion.options.forEach(option => {
            if (!option.text) return; // Pular opções vazias

            const optionElement = document.createElement('div');
            optionElement.className = 'option';
            optionElement.dataset.optionId = option.id;
            optionElement.dataset.questionId = currentQuestion.id;

            // Verificar se é a opção selecionada pelo usuário
            if (selectedOption === option.id) {
                optionElement.classList.add('selected');
            }

            optionElement.innerHTML = `
                <input type="radio" name="question-${currentQuestion.id}" id="option-${option.id}" 
                       value="${option.id}" ${selectedOption === option.id ? 'checked' : ''}>
                <label for="option-${option.id}">${option.text}</label>
            `;

            optionElement.addEventListener('click', () => {
                selectOption(option.id);
            });

            optionsContainer.appendChild(optionElement);
        });

        // Atualizar botões de navegação
        updateButtons();
    }

    // Função para selecionar uma opção
    function selectOption(optionId) {
        selectedOption = optionId;
        userAnswers[currentQuestionIndex] = optionId;

        // Atualizar visuais
        const options = optionsContainer.querySelectorAll('.option');
        options.forEach(option => {
            option.classList.remove('selected');
            const input = option.querySelector('input[type="radio"]');
            if (input.value === optionId) {
                option.classList.add('selected');
                input.checked = true;
            } else {
                input.checked = false;
            }
        });

        // Atualizar indicador de progresso
        updateProgressIndicators();

        // Atualizar botão finalizar
        updateFinishButton();
    }

    // Função para atualizar indicadores de progresso
    function updateProgressIndicators() {
        const indicators = progressContainer.querySelectorAll('.question-indicator');

        indicators.forEach((indicator, index) => {
            // Remover todas as classes especiais
            indicator.classList.remove('current', 'answered');

            // Adicionar classe atual
            if (index === currentQuestionIndex) {
                indicator.classList.add('current');
            }

            // Adicionar classe respondida se aplicável
            if (userAnswers[index] !== null) {
                indicator.classList.add('answered');
            }
        });
    }

    // Função para atualizar os botões de navegação
    function updateButtons() {
        prevBtn.disabled = currentQuestionIndex <= 0;
        nextBtn.disabled = currentQuestionIndex >= questions.length - 1;
    }

    // Função para atualizar o botão finalizar
    function updateFinishButton() {
        const allAnswered = userAnswers.every(answer => answer !== null);
        const isLastQuestion = currentQuestionIndex === questions.length - 1;
        
        // Só mostra o botão finalizar na última questão e quando todas estiverem respondidas
        finishBtn.style.display = (isLastQuestion && allAnswered) ? 'block' : 'none';
    }

    // Função para mostrar resultados finais
    function showResults() {
        // Preparar dados para enviar
        const respostasParaEnviar = questions.map((question, index) => ({
            id_questao: question.id,
            resposta_dada: userAnswers[index] || 'N/A'
        })).filter(resposta => resposta.resposta_dada !== 'N/A');

        if (respostasParaEnviar.length === 0) {
            feedbackElement.textContent = "Erro: Nenhuma resposta para enviar";
            feedbackElement.style.display = 'block';
            feedbackElement.style.color = '#dc2626';
            return;
        }

        // Mostrar loading
        feedbackElement.textContent = "Salvando suas respostas...";
        feedbackElement.style.display = 'block';
        feedbackElement.style.color = '#4884f8';

        fetch('salvar_respostas_ligacoes.php', {
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
                // Redirecionar para a página de resultados
                window.location.href = `resultados_ligacoes.php?pontuacao=${data.pontuacao}&total=${questions.length}`;
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
        // Limpar respostas
        userAnswers = new Array(questions.length).fill(null);
        currentQuestionIndex = 0;
        selectedOption = null;

        // Resetar UI
        resultSection.style.display = 'none';
        quizContainer.style.display = 'block';
        feedbackElement.style.display = 'none';

        // Recarregar primeira questão
        loadQuestion(0);
        updateProgressIndicators();
        updateFinishButton();
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
    restartBtn.addEventListener('click', restartQuiz);

    // Inicializar o quiz
    fetchQuestions();
});
