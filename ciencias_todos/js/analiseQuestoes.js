// Variáveis globais
let questoesData = [];
let alunosData = [];
const COLORS = ['#4285F4', '#34A853', '#FBBC05', '#EA4335'];

// Inicialização
document.addEventListener('DOMContentLoaded', function() {
    console.log('Página carregada, inicializando...');
    
    // Adicionar eventos para expandir/colapsar questões
    document.querySelectorAll('.question-header').forEach(header => {
        header.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('.fa-chevron-right');
            const questaoItem = this.closest('.question-item');
            
            if (content.style.display === 'none') {
                content.style.display = 'block';
                if (icon) icon.style.transform = 'rotate(90deg)';
                
                // Inicializar o gráfico quando a questão é expandida
                if (questaoItem) {
                    const questaoId = questaoItem.dataset.questaoId;
                    const canvas = document.getElementById(`pie-chart-${questaoId}`);
                    if (canvas) {
                        // Buscar dados da questão
                        const respostasA = parseInt(questaoItem.dataset.respostasA) || 0;
                        const respostasB = parseInt(questaoItem.dataset.respostasB) || 0;
                        const respostasC = parseInt(questaoItem.dataset.respostasC) || 0;
                        const respostasD = parseInt(questaoItem.dataset.respostasD) || 0;
                        
                        inicializarGraficoPizza(canvas, {
                            respostasA,
                            respostasB,
                            respostasC,
                            respostasD
                        });
                    }
                }
            } else {
                content.style.display = 'none';
                if (icon) icon.style.transform = 'rotate(0deg)';
            }
        });
    });
});

function mostrarErro(mensagem) {
    const questionList = document.querySelector('.question-list');
    if (questionList) {
        questionList.innerHTML = `
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> 
                ${mensagem}
            </div>
        `;
    }
}

function atualizarDashboard(data) {
    console.log('Atualizando dashboard com dados:', data);
    const questionList = document.querySelector('.question-list');
    
    if (!questionList) {
        console.error('Elemento question-list não encontrado!');
        return;
    }

    if (!data.questoes || data.questoes.length === 0) {
        console.log('Nenhuma questão encontrada');
        questionList.innerHTML = `
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                Nenhuma questão encontrada para esta turma.
            </div>
        `;
        return;
    }

    console.log(`Renderizando ${data.questoes.length} questões`);
    questionList.innerHTML = data.questoes.map(questao => `
        <div class="question-item" data-questao-id="${questao.id_questao}">
            <div class="question-header">
                <div class="question-title">
                    <i class="fas fa-chevron-right"></i>
                    <div>
                        <h4>${questao.titulo}</h4>
                        <div class="question-meta">
                            Disciplina: ${questao.disciplina} • 
                            <span class="question-acertos ${questao.acertos >= 70 ? 'text-green' : 'text-red'}">
                                ${questao.acertos}% de acertos
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="question-content" style="display: none;">
                <div class="question-details">
                    <div class="chart-section">
                        <h5>Distribuição das respostas:</h5>
                        <canvas id="pie-chart-${questao.id_questao}"></canvas>
                    </div>
                    <div class="alternatives-section">
                        <h5>Alternativas:</h5>
                        <div class="alternatives-list">
                            ${['a', 'b', 'c', 'd'].map(letra => `
                                <div class="alternative-item">
                                    <div class="alternative-header">
                                        <div>
                                            <span class="alternative-letter ${letra.toUpperCase() === questao.alternativa_correta ? 'letter-correct' : ''}">
                                                ${letra.toUpperCase()}
                                            </span>
                                            ${questao['alternativa_' + letra]}
                                            ${letra.toUpperCase() === questao.alternativa_correta ? 
                                                '<span class="correct-label">(Correta)</span>' : 
                                                ''}
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </div>
                
                <!-- Lista de Alunos e Respostas -->
                <div class="alunos-respostas">
                    <h5><i class="fas fa-users"></i> Respostas dos Alunos</h5>
                    <div class="alunos-lista">
                        ${questao.alunos_respostas_array && questao.alunos_respostas_array.length > 0 ? 
                            questao.alunos_respostas_array.map(resposta => `
                                <div class="aluno-resposta ${resposta.acertou ? 'resposta-correta' : 'resposta-incorreta'}">
                                    <span class="aluno-nome">${resposta.nome}</span>
                                    <span class="resposta-dada">
                                        Respondeu: <strong>${resposta.resposta_dada}</strong>
                                        ${resposta.acertou ? 
                                            '<i class="fas fa-check"></i>' : 
                                            '<i class="fas fa-times"></i>'}
                                    </span>
                                </div>
                            `).join('') : 
                            '<div class="sem-respostas">Nenhuma resposta registrada ainda.</div>'}
                    </div>
                </div>
            </div>
        </div>
    `).join('');

    console.log('Adicionando eventos às questões');
    adicionarEventosQuestoes();
}

function adicionarEventosQuestoes() {
    document.querySelectorAll('.question-header').forEach(header => {
        header.addEventListener('click', function(e) {
            console.log('Questão clicada');
            const content = this.nextElementSibling;
            const icon = this.querySelector('.fa-chevron-right');
            const questaoItem = this.closest('.question-item');
            
            if (content.style.display === 'none') {
                content.style.display = 'block';
                if (icon) icon.style.transform = 'rotate(90deg)';
                
                if (questaoItem) {
                    const questaoId = questaoItem.dataset.questaoId;
                    console.log('Inicializando gráfico para questão:', questaoId);
                    console.log('Dados disponíveis:', questoesData);
                    
                    const canvas = document.getElementById(`pie-chart-${questaoId}`);
                    if (canvas) {
                        // Converter IDs para o mesmo tipo antes de comparar
                        const questao = questoesData.find(q => String(q.id_questao) === String(questaoId));
                        if (questao) {
                            console.log('Dados da questão para o gráfico:', questao);
                            inicializarGraficoPizza(canvas, questao);
                        } else {
                            console.error('Questão não encontrada nos dados:', questaoId);
                            console.log('IDs disponíveis:', questoesData.map(q => q.id_questao));
                        }
                    } else {
                        console.error('Canvas não encontrado para questão:', questaoId);
                    }
                }
            } else {
                content.style.display = 'none';
                if (icon) icon.style.transform = 'rotate(0deg)';
            }
        });
    });
}

function inicializarGraficoPizza(canvas, dados) {
    // Destruir gráfico existente se houver
    const chartExistente = Chart.getChart(canvas);
    if (chartExistente) {
        chartExistente.destroy();
    }

    const data = [
        dados.respostasA,
        dados.respostasB,
        dados.respostasC,
        dados.respostasD
    ];

    // Criar novo gráfico
    new Chart(canvas, {
        type: 'pie',
        data: {
            labels: ['A', 'B', 'C', 'D'],
            datasets: [{
                data: data,
                backgroundColor: [
                    '#ef4444', // Vermelho
                    '#f59e0b', // Laranja
                    '#10b981', // Verde
                    '#3b82f6'  // Azul
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                            return `${label}: ${value} respostas (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
}

function atualizarGraficoDesempenho(questoes) {
    const canvas = document.getElementById('performance-chart');
    if (!canvas) return;

    const chartInstance = Chart.getChart(canvas);
    if (chartInstance) {
        chartInstance.destroy();
    }

    const labels = questoes.map(q => `Q${q.id_questao}`);
    const acertos = questoes.map(q => q.acertos);
    const erros = questoes.map(q => 100 - q.acertos);

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Acertos (%)',
                    data: acertos,
                    backgroundColor: '#4285F4'
                },
                {
                    label: 'Erros (%)',
                    data: erros,
                    backgroundColor: '#EA4335'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: value => `${value}%`
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
}

function atualizarTabelaAlunos(alunos) {
    const alunosView = document.getElementById('alunos-view');
    if (!alunosView) return;

    if (!alunos || alunos.length === 0) {
        alunosView.innerHTML = '<div class="alert alert-info">Nenhum aluno encontrado para esta turma.</div>';
        return;
    }

    alunosView.innerHTML = `
        <table class="students-table">
            <thead>
                <tr>
                    <th>Nome do Aluno</th>
                    <th class="center">Questões Respondidas</th>
                    <th class="center">Acertos</th>
                    <th class="center">Desempenho</th>
                    <th class="center">Ações</th>
                </tr>
            </thead>
            <tbody>
                ${alunos.map(aluno => {
                    const percentual = aluno.questoes_respondidas > 0 
                        ? Math.round((aluno.acertos / aluno.questoes_respondidas) * 100)
                        : 0;
                    return `
                        <tr>
                            <td>${aluno.nome}</td>
                            <td class="center">${aluno.questoes_respondidas}</td>
                            <td class="center">${aluno.acertos}</td>
                            <td class="center">
                                <div class="performance-bar">
                                    <div class="performance-fill ${getPerformanceClass(percentual)}"
                                         style="width: ${percentual}%">
                                    </div>
                                </div>
                            </td>
                            <td class="center">
                                <button class="details-button" data-aluno-id="${aluno.id}">
                                    <i class="fas fa-info-circle"></i> Ver detalhes
                                </button>
                            </td>
                        </tr>
                    `;
                }).join('')}
            </tbody>
        </table>
    `;

    // Adicionar eventos aos botões de detalhes
    document.querySelectorAll('.details-button').forEach(button => {
        button.addEventListener('click', (e) => {
            const alunoId = parseInt(e.target.closest('.details-button').dataset.alunoId);
            mostrarDetalhesAluno(alunoId);
        });
    });
}

function mostrarDetalhesAluno(alunoId) {
    const aluno = alunosData.find(a => a.id === alunoId);
    if (!aluno) return;

    // Criar o modal
    const modal = document.createElement('div');
    modal.className = 'modal';
    
    // Criar o conteúdo do modal
    const modalContent = document.createElement('div');
    modalContent.className = 'modal-content';

    // Buscar as respostas do aluno nas questões
    const respostasAluno = [];
    questoesData.forEach(questao => {
        const respostaAluno = questao.alunos_respostas_array?.find(r => r.nome === aluno.nome);
        if (respostaAluno) {
            respostasAluno.push({
                questao: questao,
                resposta: respostaAluno
            });
        }
    });

    modalContent.innerHTML = `
        <div class="modal-header">
            <h3>Desempenho detalhado: ${aluno.nome}</h3>
            <button class="close-modal">&times;</button>
        </div>
        
        <div class="modal-body">
            <div class="aluno-stats">
                <div class="stat-item">
                    <span class="stat-label">Total de questões respondidas:</span>
                    <span class="stat-value">${aluno.questoes_respondidas}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Total de acertos:</span>
                    <span class="stat-value">${aluno.acertos}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Percentual de acertos:</span>
                    <span class="stat-value ${getPerformanceClass(aluno.acertos / aluno.questoes_respondidas * 100)}">
                        ${Math.round((aluno.acertos / aluno.questoes_respondidas) * 100)}%
                    </span>
                </div>
            </div>

            <h4>Respostas por questão:</h4>
            <div class="respostas-container">
                <table class="students-table">
                    <thead>
                        <tr>
                            <th>Questão</th>
                            <th>Disciplina</th>
                            <th class="center">Resposta dada</th>
                            <th class="center">Resposta correta</th>
                            <th class="center">Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${respostasAluno.map(item => `
                            <tr>
                                <td>${item.questao.titulo}</td>
                                <td>${item.questao.disciplina}</td>
                                <td class="center">
                                    <span class="alternative-letter ${item.resposta.acertou ? 'letter-correct' : ''}">
                                        ${item.resposta.resposta_dada}
                                    </span>
                                </td>
                                <td class="center">
                                    <span class="alternative-letter letter-correct">
                                        ${item.questao.alternativa_correta}
                                    </span>
                                </td>
                                <td class="center ${item.resposta.acertou ? 'text-green' : 'text-red'}">
                                    ${item.resposta.acertou ? 'Acertou' : 'Errou'}
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </div>
        </div>
    `;

    modal.appendChild(modalContent);
    document.body.appendChild(modal);

    // Eventos do modal
    modal.querySelector('.close-modal').addEventListener('click', () => {
        document.body.removeChild(modal);
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            document.body.removeChild(modal);
        }
    });
}

function getPerformanceClass(percentual) {
    if (percentual >= 70) return 'performance-good';
    if (percentual >= 50) return 'performance-medium';
    return 'performance-poor';
}
