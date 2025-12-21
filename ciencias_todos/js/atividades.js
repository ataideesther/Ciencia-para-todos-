document.addEventListener('DOMContentLoaded', function () {
    // Variáveis globais
    let currentQuestionIndex = 0;
    let questions = [];
    let userAnswers = [];
    let selectedOption = null;
    let isAnswered = false;

    // Elementos DOM
    const questionText = document.getElementById('question-text');
    const optionsContainer = document.getElementById('options-container');
    const progressContainer = document.getElementById('progress-container');
    const quizTitle = document.getElementById('quiz-title');
    const prevBtn = document.getElementById('prev-btn');
    const checkBtn = document.getElementById('check-btn');
    const nextBtn = document.getElementById('next-btn');
    const feedbackElement = document.getElementById('feedback');

    // Função para buscar questões do servidor
    function fetchQuestions() {
        // Aqui simularemos a resposta do PHP, em um ambiente real
        // essa seria uma chamada fetch() ou XMLHttpRequest para o backend

        // Simulação da resposta do PHP
        const mockData = {
            title: "Conhecimentos Gerais",
            questions: [
                {
                    id: 1,
                    text: "Qual é a capital do Brasil?",
                    options: [
                        { id: 'a', text: "São Paulo" },
                        { id: 'b', text: "Rio de Janeiro" },
                        { id: 'c', text: "Brasília" },
                        { id: 'd', text: "Salvador" }
                    ],
                    correctAnswer: 'c'
                },
                {
                    id: 2,
                    text: "Quem escreveu 'Dom Casmurro'?",
                    options: [
                        { id: 'a', text: "José de Alencar" },
                        { id: 'b', text: "Machado de Assis" },
                        { id: 'c', text: "Carlos Drummond de Andrade" },
                        { id: 'd', text: "Clarice Lispector" }
                    ],
                    correctAnswer: 'b'
                },
                {
                    id: 3,
                    text: "Qual é o maior planeta do Sistema Solar?",
                    options: [
                        { id: 'a', text: "Terra" },
                        { id: 'b', text: "Marte" },
                        { id: 'c', text: "Saturno" },
                        { id: 'd', text: "Júpiter" }
                    ],
                    correctAnswer: 'd'
                },
                {
                    id: 4,
                    text: "Qual é o símbolo químico do ouro?",
                    options: [
                        { id: 'a', text: "Au" },
                        { id: 'b', text: "Ag" },
                        { id: 'c', text: "Fe" },
                        { id: 'd', text: "Or" }
                    ],
                    correctAnswer: 'a'
                },
                {
                    id: 5,
                    text: "Em que ano ocorreu a independência do Brasil?",
                    options: [
                        { id: 'a', text: "1808" },
                        { id: 'b', text: "1822" },
                        { id: 'c', text: "1889" },
                        { id: 'd', text: "1500" }
                    ],
                    correctAnswer: 'b'
                }
            ]
        };

        // Em um ambiente real, isso viria do PHP:
        // fetch('get_questions.php')
        //     .then(response => response.json())
        //     .then(data => {
        //         processQuestions(data);
        //     })
        //     .catch(error => console.error('Erro ao carregar questões:', error));

        // Processando os dados recebidos
        processQuestions(mockData);
    }

    // Função para processar as questões recebidas
    function processQuestions(data) {
        quizTitle.textContent = data.title;
        questions = data.questions;

        // Inicializar o array de respostas do usuário
        userAnswers = new Array(questions.length).fill(null);

        // Criar indicadores de progresso
        createProgressIndicators();

        // Carregar a primeira questão
        loadQuestion(0);
    }

    // Função para criar os indicadores de progresso
    function createProgressIndicators() {
        progressContainer.innerHTML = '';

        for (let i = 0; i < questions.length; i++) {
            const indicator = document.createElement('div');
            indicator.className = 'question-indicator';
            indicator.textContent = (i + 1).toString();

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

        // Verificar se o usuário já respondeu essa questão
        isAnswered = userAnswers[index] !== null;
        selectedOption = userAnswers[index];

        // Adicionar opções de resposta
        currentQuestion.options.forEach(option => {
            const optionElement = document.createElement('div');
            optionElement.className = 'option';

            // Verificar se é a opção selecionada pelo usuário
            if (selectedOption === option.id) {
                optionElement.classList.add('selected');
            }

            // Se já respondeu, mostrar feedback
            if (isAnswered) {
                if (option.id === currentQuestion.correctAnswer) {
                    optionElement.classList.add('correct');
                } else if (selectedOption === option.id && selectedOption !== currentQuestion.correctAnswer) {
                    optionElement.classList.add('incorrect');
                }
            }

            optionElement.innerHTML = `
                    <input type="radio" name="question-${currentQuestion.id}" id="option-${option.id}" 
                           value="${option.id}" ${selectedOption === option.id ? 'checked' : ''} 
                           ${isAnswered ? 'disabled' : ''}>
                    <label for="option-${option.id}">${option.text}</label>
                `;

            // Adicionar evento de clique se a questão ainda não foi respondida
            if (!isAnswered) {
                optionElement.addEventListener('click', () => {
                    selectOption(option.id);
                });
            }

            optionsContainer.appendChild(optionElement);
        });

        // Atualizar botões de navegação
        updateButtons();

        // Esconder feedback se trocou de questão
        feedbackElement.style.display = 'none';
    }

    // Função para selecionar uma opção
    function selectOption(optionId) {
        selectedOption = optionId;

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

        // Ativar botão de verificar
        checkBtn.disabled = false;
    }

    // Função para verificar resposta
    function checkAnswer() {
        if (selectedOption === null) return;

        // Marcar questão como respondida
        isAnswered = true;
        userAnswers[currentQuestionIndex] = selectedOption;

        const currentQuestion = questions[currentQuestionIndex];
        const isCorrect = selectedOption === currentQuestion.correctAnswer;

        // Atualizar visual das opções
        const options = optionsContainer.querySelectorAll('.option');
        options.forEach(option => {
            const input = option.querySelector('input[type="radio"]');
            input.disabled = true;

            if (input.value === currentQuestion.correctAnswer) {
                option.classList.add('correct');
            } else if (input.value === selectedOption && !isCorrect) {
                option.classList.add('incorrect');
            }
        });

        // Atualizar indicador de progresso
        updateProgressIndicators();

        // Mostrar feedback
        feedbackElement.className = 'feedback';
        feedbackElement.classList.add(isCorrect ? 'correct' : 'incorrect');
        feedbackElement.textContent = isCorrect
            ? "Parabéns! Você acertou."
            : `Resposta incorreta. A resposta correta é a opção ${currentQuestion.correctAnswer.toUpperCase()}.`;
        feedbackElement.style.display = 'block';

        // Atualizar botões
        checkBtn.disabled = true;
        nextBtn.disabled = currentQuestionIndex >= questions.length - 1;

        // Ativar o botão próximo automaticamente se não for a última questão
        if (currentQuestionIndex < questions.length - 1) {
            nextBtn.focus();
        }
    }

    // Função para atualizar indicadores de progresso
    function updateProgressIndicators() {
        const indicators = progressContainer.querySelectorAll('.question-indicator');

        indicators.forEach((indicator, index) => {
            // Remover todas as classes especiais
            indicator.classList.remove('current', 'correct', 'incorrect');

            // Adicionar classe atual
            if (index === currentQuestionIndex) {
                indicator.classList.add('current');
            }

            // Adicionar classe de resposta se aplicável
            if (userAnswers[index] !== null) {
                const question = questions[index];
                const isCorrect = userAnswers[index] === question.correctAnswer;

                if (isCorrect) {
                    indicator.classList.add('correct');
                } else {
                    indicator.classList.add('incorrect');
                }

                // Adicionar a letra da resposta escolhida
                indicator.textContent = `${index + 1}${userAnswers[index].toUpperCase()}`;
            } else {
                indicator.textContent = (index + 1).toString();
            }
        });
    }

    // Função para atualizar os botões de navegação
    function updateButtons() {
        prevBtn.disabled = currentQuestionIndex <= 0;
        nextBtn.disabled = currentQuestionIndex >= questions.length - 1 || !isAnswered;
        checkBtn.disabled = selectedOption === null || isAnswered;
    }

    // Event listeners para os botões
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

    checkBtn.addEventListener('click', checkAnswer);

    // Inicializar o quiz
    fetchQuestions();
});