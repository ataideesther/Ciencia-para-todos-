// jogoCitologia2.js

// Função para embaralhar um array (algoritmo Fisher-Yates)
function embaralharArray(array) {
    let currentIndex = array.length;
    let temporaryValue, randomIndex;

    while (currentIndex !== 0) {
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}

// Função para preencher os dropdowns com opções embaralhadas
function preencherDropdowns() {
    const opcoes = [
        { valor: "cloroplasto", texto: "Cloroplasto" },
        { valor: "lisossomo", texto: "Lisossomo" },
        { valor: "mitocondria", texto: "Mitocôndria" },
        { valor: "ribossomo", texto: "Ribossomo" },
        { valor: "reticulo", texto: "Retículo Endoplasmático" },
        { valor: "vacuolo", texto: "Vacúolo" },
        { valor: "centriolo", texto: "Centríolo" },
        { valor: "golgi", texto: "Complexo de Golgi" }
    ];

    for (let i = 1; i <= 8; i++) {
        const dropdown = document.getElementById("questao" + i);

        // Limpa todas as opções, menos a primeira (padrão)
        while (dropdown.options.length > 1) {
            dropdown.remove(1);
        }

        const opcoesEmbaralhadas = embaralharArray([...opcoes]);

        opcoesEmbaralhadas.forEach(opcao => {
            const novaOpcao = document.createElement("option");
            novaOpcao.value = opcao.valor;
            novaOpcao.text = opcao.texto;
            dropdown.add(novaOpcao);
        });
    }
}

// Função para reiniciar o jogo com animação
function reiniciarJogo() {
    // Primeiro, escondemos as mensagens de feedback com animação
    const mensagemSucesso = document.getElementById('mensagem-sucesso');
    const mensagemErro = document.getElementById('mensagem-erro');

    mensagemSucesso.classList.remove('visible');
    mensagemErro.classList.remove('visible');

    // Depois de um curto intervalo para a animação, tiramos o deslocamento do container
    setTimeout(() => {
        document.querySelector('.container').classList.remove('shifted');

        // Resetamos as seleções e classes dos elementos
        for (let i = 1; i <= 8; i++) {
            const select = document.getElementById("questao" + i);

            // Adicionamos transição suave para retornar à cor original
            select.style.transition = "background-color 0.5s ease, color 0.5s ease";
            select.className = "";
            select.value = "";

            // Removemos a transição depois para evitar interferir com próximas mudanças
            setTimeout(() => {
                select.style.transition = "";
            }, 500);
        }

        // Reembaralha as opções
        preencherDropdowns();
    }, 300);
}

// Função de verificação das respostas com animação
function confirmar() {
    const respostasCorretas = {
        questao1: "cloroplasto",
        questao2: "lisossomo",
        questao3: "mitocondria",
        questao4: "ribossomo",
        questao5: "reticulo",
        questao6: "vacuolo",
        questao7: "centriolo",
        questao8: "golgi"
    };

    let todasCorretas = true;
    let animacaoCompletada = 0;
    const totalQuestoes = Object.keys(respostasCorretas).length;

    // Adicionamos a classe shifted ao container para iniciar a animação de deslocamento
    document.querySelector('.container').classList.add('shifted');

    // Verificamos cada resposta com um delay sequencial para criar efeito animado
    Object.keys(respostasCorretas).forEach((id, index) => {
        const select = document.getElementById(id);

        setTimeout(() => {
            if (select.value === respostasCorretas[id]) {
                select.className = "correct";
            } else {
                select.className = "incorrect";
                todasCorretas = false;
            }

            // Verificamos se esta é a última animação
            animacaoCompletada++;
            if (animacaoCompletada === totalQuestoes) {
                // Mostramos a mensagem de feedback adequada após todas as verificações
                setTimeout(() => {
                    if (todasCorretas) {
                        document.getElementById('mensagem-sucesso').classList.add('visible');
                    } else {
                        document.getElementById('mensagem-erro').classList.add('visible');
                    }
                }, 300);
            }
        }, index * 100); // Cada verificação tem um delay de 100ms
    });
}

// Função para detectar dispositivos móveis
function isMobileDevice() {
    return (window.innerWidth <= 576);
}

// Função para ajustar o layout baseado no tamanho da tela
function ajustarLayout() {
    const container = document.querySelector('.container');
    const mensagemSucesso = document.getElementById('mensagem-sucesso');
    const mensagemErro = document.getElementById('mensagem-erro');

    if (isMobileDevice()) {
        // Ajustes para dispositivos móveis
        if (mensagemSucesso.classList.contains('visible') || mensagemErro.classList.contains('visible')) {
            container.style.marginBottom = '380px';
        } else {
            container.style.marginBottom = '20px';
        }
    } else {
        // Configuração padrão para desktop
        container.style.marginBottom = '';
    }
}

// Função para configurar os botões
function configurarBotoes() {
    // Botão "Tentar Novamente"
    const botaoTentar = document.getElementById('botao-tentar');
    if (botaoTentar) {
        botaoTentar.addEventListener('click', reiniciarJogo);
    }

    // Botão "Ir para o Início"
    const botaoInicio = document.getElementById('botao-inicio');
    if (botaoInicio) {
        botaoInicio.addEventListener('click', function () {
            window.location.href = "paginaInicialAluno.php";
        });
    }

    // Botão "Confirmar"
    const botaoConfirmar = document.getElementById('botao-confirmar');
    if (botaoConfirmar) {
        botaoConfirmar.addEventListener('click', confirmar);
    }
}

// Inicia tudo ao carregar a página
document.addEventListener('DOMContentLoaded', function () {
    preencherDropdowns();
    configurarBotoes();

    // Adicionamos um listener para redimensionamento da janela
    window.addEventListener('resize', ajustarLayout);

    // Verificamos o layout inicial
    ajustarLayout();

    // Adiciona evento de click diretamente ao botão de tentar novamente como backup
    const botaoTentar = document.getElementById('botao-tentar');
    if (botaoTentar) {
        botaoTentar.onclick = reiniciarJogo;
    }

    // Adiciona evento de click diretamente ao botão confirmar como backup
    const botaoConfirmar = document.getElementById('botao-confirmar');
    if (botaoConfirmar) {
        botaoConfirmar.onclick = confirmar;
    }
});