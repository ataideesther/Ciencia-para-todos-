// Função para embaralhar um array (algoritmo Fisher-Yates)
function embaralharArray(array) {
    let currentIndex = array.length;
    let temporaryValue, randomIndex;

    // Enquanto existirem elementos para embaralhar
    while (currentIndex !== 0) {
        // Seleciona um elemento restante
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // Troca o elemento atual com o aleatório
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}

// Função para preencher os dropdowns com opções embaralhadas
function preencherDropdowns() {
    // As opções que cada dropdown terá
    const opcoes = [
        { valor: "citoplasma", texto: "Citoplasma" },
        { valor: "membrana", texto: "Membrana Plasmática" },
        { valor: "parede", texto: "Parede Celular" },
        { valor: "nucleo", texto: "Núcleo" }
    ];

    // Para cada dropdown
    for (let i = 1; i <= 4; i++) {
        const dropdown = document.getElementById("questao" + i);

        // Limpar dropdown mantendo apenas a opção padrão
        while (dropdown.options.length > 1) {
            dropdown.remove(1);
        }

        // Criar uma cópia das opções e embaralhar
        const opcoesEmbaralhadas = embaralharArray([...opcoes]);

        // Adicionar opções embaralhadas ao dropdown
        opcoesEmbaralhadas.forEach(opcao => {
            const novaOpcao = document.createElement("option");
            novaOpcao.value = opcao.valor;
            novaOpcao.text = opcao.texto;
            dropdown.add(novaOpcao);
        });
    }

    // Configurar os botões de navegação
    configurarBotoes();
}

// Função para configurar os botões
function configurarBotoes() {
    // Botão para ir para o próximo módulo
    if (document.getElementById('botao-proximo')) {
        document.getElementById('botao-proximo').addEventListener('click', function () {
            window.location.href = 'jogoCitologia2.php';
        });
    }

    // Botão para tentar novamente - CORRIGIDO
    document.getElementById('botao-tentar').addEventListener('click', function () {
        reiniciarJogo();
    });

    // Botão para voltar à página inicial
    if (document.getElementById('botao-inicio')) {
        document.getElementById('botao-inicio').addEventListener('click', function () {
            window.location.href = 'paginaInicialAluno.php';
        });
    }
}

// Função para reiniciar o jogo
function reiniciarJogo() {
    // Ocultar mensagens de feedback com animação
    const mensagemSucesso = document.getElementById('mensagem-sucesso');
    const mensagemErro = document.getElementById('mensagem-erro');
    const container = document.querySelector('.container');

    if (mensagemSucesso.classList.contains('visible')) {
        mensagemSucesso.classList.add('hiding');
        setTimeout(() => {
            mensagemSucesso.classList.remove('visible');
            mensagemSucesso.classList.remove('hiding');
        }, 500);
    }

    if (mensagemErro.classList.contains('visible')) {
        mensagemErro.classList.add('hiding');
        setTimeout(() => {
            mensagemErro.classList.remove('visible');
            mensagemErro.classList.remove('hiding');
        }, 500);
    }

    // Reposicionar o container com os campos de resposta
    if (container.classList.contains('shifted')) {
        // Adiciona uma pequena animação de retorno
        const perguntas = document.querySelectorAll('.pergunta');
        perguntas.forEach(pergunta => {
            pergunta.style.transition = 'transform 0.5s ease-in-out, opacity 0.5s ease-in-out';
            pergunta.style.transform = 'translateX(0)';
        });

        // Espera a animação dos campos terminar antes de retirar a classe shifted
        setTimeout(() => {
            container.classList.remove('shifted');
        }, 50);
    }

    // Limpar as seleções e classes
    for (let i = 1; i <= 4; i++) {
        const select = document.getElementById("questao" + i);
        select.value = "";
        select.className = "";
    }
}

// Função modificada de confirmação
function confirmar() {
    const respostasCorretas = {
        questao1: "citoplasma",
        questao2: "membrana",
        questao3: "parede",
        questao4: "nucleo"
    };

    let todasCorretas = true;

    for (let id in respostasCorretas) {
        const select = document.getElementById(id);
        if (select.value === respostasCorretas[id]) {
            select.className = "correct";
        } else {
            select.className = "incorrect";
            todasCorretas = false;
        }
    }

    // Deslocar o container para abrir espaço
    document.querySelector('.container').classList.add('shifted');

    // Mostrar a mensagem apropriada com animação
    if (todasCorretas) {
        const mensagemSucesso = document.getElementById('mensagem-sucesso');
        mensagemSucesso.classList.add('preparing');
        setTimeout(() => {
            mensagemSucesso.classList.add('visible');
            mensagemSucesso.classList.remove('preparing');
        }, 50);
    } else {
        const mensagemErro = document.getElementById('mensagem-erro');
        mensagemErro.classList.add('preparing');
        setTimeout(() => {
            mensagemErro.classList.add('visible');
            mensagemErro.classList.remove('preparing');
        }, 50);
    }
}

// Inicializar os dropdowns quando a página carregar
window.onload = preencherDropdowns;