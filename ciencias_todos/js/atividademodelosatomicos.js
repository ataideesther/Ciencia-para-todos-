document.addEventListener('DOMContentLoaded', function () {
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

    // Função para buscar questões do servidor
    function fetchQuestions() {
        // ID fixo para a trilha de Modelos Atômicos
        const idTrilha = 2;

        // Mostrar estado de carregamento
        quizTitle.textContent = "Carregando...";
        questionText.textContent = "Por favor, aguarde enquanto carregamos as questões.";

        fetch(`get_questions_modelos.php?id_trilha=${idTrilha}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Falha ao carregar questões');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
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
        currentQuestionIndex = index;
        updateProgressIndicators();

        const currentQuestion = questions[index];
        questionText.textContent = currentQuestion.text;
        optionsContainer.innerHTML = '';
        selectedOption = userAnswers[index];

        // Adicionar opções de resposta
        currentQuestion.options.forEach(option => {
            if (!option.text) return;

            const optionElement = document.createElement('div');
            optionElement.className = 'option';
            optionElement.dataset.optionId = option.id;
            optionElement.dataset.questionId = currentQuestion.id;

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
        userAnswers[currentQuestionIndex] = optionId.trim(); // Garantir que não há espaços extras

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

        updateButtons();
    }

    // Função para atualizar indicadores de progresso
    function updateProgressIndicators() {
        const indicators = progressContainer.querySelectorAll('.question-indicator');
        indicators.forEach((indicator, index) => {
            indicator.classList.remove('current');
            if (index === currentQuestionIndex) {
                indicator.classList.add('current');
            }
            if (userAnswers[index] !== null) {
                indicator.classList.add('answered');
            } else {
                indicator.classList.remove('answered');
            }
        });
    }

    // Função para atualizar os botões de navegação
    function updateButtons() {
        prevBtn.disabled = currentQuestionIndex <= 0;
        
        // Mostrar botão Finalizar na última questão se houver resposta selecionada
        if (currentQuestionIndex === questions.length - 1) {
            nextBtn.style.display = 'none';
            finishBtn.style.display = 'block';
            finishBtn.disabled = !userAnswers[currentQuestionIndex];
        } else {
            nextBtn.style.display = 'block';
            finishBtn.style.display = 'none';
            nextBtn.disabled = !userAnswers[currentQuestionIndex];
        }
    }

    // Função para finalizar o quiz e enviar respostas
    function finishQuiz() {
        // Verificar se todas as questões foram respondidas
        if (userAnswers.includes(null)) {
            alert('Por favor, responda todas as questões antes de finalizar.');
            return;
        }

        // Preparar dados para enviar
        const respostasParaEnviar = questions.map((question, index) => ({
            id_questao: question.id,
            resposta_dada: userAnswers[index].trim() // Garantir que não há espaços extras
        }));

        // Mostrar loading
        feedbackElement.textContent = "Salvando suas respostas...";
        feedbackElement.style.display = 'block';
        feedbackElement.style.color = '#4884f8';

        fetch('salvar_respostas_modelos.php', {
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
                window.location.href = 'resultado_quiz_modelos.php';
            } else {
                throw new Error(data.error || 'Erro desconhecido ao salvar respostas');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            feedbackElement.textContent = "Erro ao salvar respostas: " + error.message;
            feedbackElement.style.color = '#dc2626';
            feedbackElement.style.display = 'block';
        });
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

    finishBtn.addEventListener('click', finishQuiz);

    // Inicializar o quiz
    fetchQuestions();
});