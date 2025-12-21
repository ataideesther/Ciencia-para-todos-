<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'professor') {
    header('Location: profLogin.php');
    exit();
}

// Conexão com o banco de dados
$hostname = "127.0.0.1";
$user = "root";
$password = "";
$database = "cienciadb";

$conexao = new mysqli($hostname, $user, $password, $database);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Verificar se uma turma foi selecionada
$turma_id = isset($_GET['turma_id']) ? $_GET['turma_id'] : null;

// Buscar questões por turma e suas estatísticas
$sql_questoes = "SELECT 
    q.id_questao,
    q.enunciado as titulo,
    t.nome_trilha as disciplina,
    q.alternativa_a,
    q.alternativa_b,
    q.alternativa_c,
    q.alternativa_d,
    q.alternativa_correta,
    q.id_trilha,
    COUNT(DISTINCT r.id_resposta) as total_respostas,
    COALESCE(SUM(CASE WHEN r.resposta_dada = q.alternativa_correta THEN 1 ELSE 0 END), 0) as acertos,
    COALESCE(SUM(CASE WHEN r.resposta_dada = 'A' THEN 1 ELSE 0 END), 0) as respostasA,
    COALESCE(SUM(CASE WHEN r.resposta_dada = 'B' THEN 1 ELSE 0 END), 0) as respostasB,
    COALESCE(SUM(CASE WHEN r.resposta_dada = 'C' THEN 1 ELSE 0 END), 0) as respostasC,
    COALESCE(SUM(CASE WHEN r.resposta_dada = 'D' THEN 1 ELSE 0 END), 0) as respostasD,
    GROUP_CONCAT(
        DISTINCT CONCAT(
            c.nome, ':', 
            r.resposta_dada, ':',
            CASE WHEN r.resposta_dada = q.alternativa_correta THEN '1' ELSE '0' END
        ) SEPARATOR '|'
    ) as alunos_respostas
FROM questao q
LEFT JOIN trilhas t ON q.id_trilha = t.id_trilha
LEFT JOIN resposta r ON q.id_questao = r.id_questao
LEFT JOIN cadastro c ON r.id_aluno = c.id
WHERE (c.id_professor = 0 OR c.id_professor IS NULL)";

// Remover filtro de turma
if ($turma_id) {
    $sql_questoes .= " AND c.id_turmas = " . intval($turma_id);
}

$sql_questoes .= " GROUP BY 
    q.id_questao,
    q.enunciado,
    t.nome_trilha,
    q.alternativa_a,
    q.alternativa_b,
    q.alternativa_c,
    q.alternativa_d,
    q.alternativa_correta,
    q.id_trilha";

// Buscar desempenho dos alunos
$sql_alunos = "SELECT 
c.id,
c.nome,
c.id_turmas,
COALESCE(COUNT(DISTINCT r.id_questao), 0) as questoes_respondidas,
COALESCE(SUM(CASE WHEN r.resposta_dada = q.alternativa_correta THEN 1 ELSE 0 END), 0) as acertos,
GROUP_CONCAT(
    DISTINCT CONCAT_WS(':', 
        q.id_questao,
        COALESCE(r.resposta_dada, ''),
        CASE WHEN r.resposta_dada = q.alternativa_correta THEN '1' ELSE '0' END,
        COALESCE(q.enunciado, ''),
        COALESCE(t.nome_trilha, '')
    ) SEPARATOR '|'
) as respostas_detalhadas
FROM cadastro c
LEFT JOIN resposta r ON c.id = r.id_aluno
LEFT JOIN questao q ON r.id_questao = q.id_questao
LEFT JOIN trilhas t ON q.id_trilha = t.id_trilha
WHERE c.id_professor = 0
GROUP BY c.id, c.nome, c.id_turmas
HAVING questoes_respondidas > 0";




$resultado_questoes = $conexao->query($sql_questoes);
if (!$resultado_questoes) {
    error_log("Erro na consulta de questões: " . $conexao->error);
    error_log("SQL questões executado: " . $sql_questoes);
}

$questoes = [];
if ($resultado_questoes) {
    error_log("Número de questões encontradas: " . $resultado_questoes->num_rows);
    while ($row = $resultado_questoes->fetch_assoc()) {
        // Debug para verificar os dados brutos
        error_log("Dados da questão " . $row['id_questao'] . ": " . print_r($row, true));
        
        // Processar respostas dos alunos
        $alunosProcessados = [];
        if (!empty($row['alunos_respostas'])) {
            error_log("Respostas dos alunos para questão " . $row['id_questao'] . ": " . $row['alunos_respostas']);
            $respostas = explode('|', $row['alunos_respostas']);
            foreach ($respostas as $resposta) {
                $partes = explode(':', $resposta);
                if (count($partes) >= 3) {
                    $alunosProcessados[] = [
                        'nome' => $partes[0],
                        'resposta_dada' => $partes[1],
                        'acertou' => $partes[2] == '1'
                    ];
                }
            }
        }
        $row['alunos_respostas_array'] = $alunosProcessados;
        
        // Debug para verificar o array processado
        error_log("Alunos processados para questão " . $row['id_questao'] . ": " . print_r($alunosProcessados, true));

        // Inicializar valores numéricos
        $row['total_respostas'] = intval($row['total_respostas']);
        $row['acertos'] = $row['total_respostas'] > 0 
            ? round(($row['acertos'] / $row['total_respostas']) * 100) 
            : 0;
        $row['respostasA'] = intval($row['respostasA']);
        $row['respostasB'] = intval($row['respostasB']);
        $row['respostasC'] = intval($row['respostasC']);
        $row['respostasD'] = intval($row['respostasD']);

        $questoes[] = $row;
    }
}

$resultado_alunos = $conexao->query($sql_alunos);
if (!$resultado_alunos) {
    error_log("Erro na consulta de alunos: " . $conexao->error);
    error_log("SQL executado: " . $sql_alunos);
}

$alunos = [];
if ($resultado_alunos) {
    $num_alunos = $resultado_alunos->num_rows;
    error_log("Número de alunos encontrados: " . $num_alunos);
    
    while ($row = $resultado_alunos->fetch_assoc()) {
        // Processar respostas detalhadas
        $respostasDetalhadas = [];
        if (!empty($row['respostas_detalhadas'])) {
            $respostas = explode('|', $row['respostas_detalhadas']);
            foreach ($respostas as $resposta) {
                $partes = explode(':', $resposta);
                if (count($partes) >= 5) {
                    $respostasDetalhadas[] = [
                        'questao_id' => $partes[0],
                        'resposta_dada' => $partes[1],
                        'acertou' => $partes[2] == '1',
                        'titulo' => $partes[3],
                        'disciplina' => $partes[4]
                    ];
                }
            }
        }
        
        $row['questoes_respondidas'] = intval($row['questoes_respondidas']);
        $row['acertos'] = intval($row['acertos']);
        $row['respostas_detalhadas_array'] = $respostasDetalhadas;
        
        $alunos[] = $row;
    }
}

// Debug
error_log("Total de questões encontradas: " . count($questoes));
error_log("Total de alunos encontrados: " . count($alunos));

$conexao->close();

// Preparar dados para o JavaScript
$dados_iniciais = [
    'questoes' => $questoes,
    'alunos' => $alunos,
    'success' => true
];

// Debug para verificar os dados
error_log("Dados iniciais: " . print_r($dados_iniciais, true));
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/analisedasquestoes.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <title>Ciência para todos - Análise de Questões</title>
    <script>
        // Verificar se o Chart.js foi carregado corretamente
        window.addEventListener('load', function() {
            if (typeof Chart === 'undefined') {
                console.error('Chart.js não foi carregado corretamente!');
            } else {
                console.log('Chart.js carregado com sucesso!');
            }
        });

        // Passar dados iniciais para o JavaScript
        window.initialData = <?php echo json_encode($dados_iniciais); ?>;
        console.log('Dados iniciais carregados:', window.initialData);
    </script>
</head>
<body>
<?php include_once('menuProfessor.php'); ?>
    <div id="Titulo">
    <header>
        <h1>Análise Detalhada das Questões</h1>
    </header>
    
    <!-- Conteúdo principal -->
    <div class="content">
        <div>
            <h2 class="section-header">Dashboard da Turma</h2>
            
            <!-- Filtros e controles -->
            <div class="filter-bar">
                <div class="filter-group">
                    <i class="fas fa-filter filter-icon"></i>
                    <span class="filter-label">Turma:</span>
                    <form id="turma-form" method="GET" action="">
                        <select id="disciplina-select" name="turma_id" onchange="this.form.submit()">
                            <option value="">Selecione uma turma</option>
                            <?php
                                $conexao = new mysqli($hostname, $user, $password, $database);
                                if ($conexao->connect_error) {
                                    die("Erro na conexão: " . $conexao->connect_error);
                                }

                                // Buscar todas as turmas
                                $sql = "SELECT id_turma, nome_turma FROM turmas ORDER BY nome_turma";
                                $resultado = $conexao->query($sql);
                                
                                if (!$resultado) {
                                    error_log("Erro na consulta de turmas: " . $conexao->error);
                                }

                                if ($resultado && $resultado->num_rows > 0) {
                                    while($row = $resultado->fetch_assoc()) {
                                        $selected = ($turma_id == $row['id_turma']) ? 'selected' : '';
                                        echo "<option value='".$row['id_turma']."' ".$selected.">".$row['nome_turma']."</option>";
                                    }
                                } else {
                                    echo "<option value=''>Nenhuma turma encontrada</option>";
                                }
                                $conexao->close();
                            ?>
                        </select>
                    </form>
                </div>
                
                <div class="view-buttons">
                    <button class="view-button active" id="view-questoes">
                        <i class="fas fa-list"></i> Questões
                    </button>
                </div>
            </div>
            
           
            <h2 class="section-header">Desempenho Geral</h2>
        
        
        <!-- Lista de Questões -->
        <div id="questoes-view" class="question-list">
            <?php if (empty($questoes)): ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <?php echo $turma_id ? 'Nenhuma questão encontrada para esta turma.' : 'Selecione uma turma para ver as questões.'; ?>
                </div>
            <?php else: ?>
                <?php foreach ($questoes as $questao): ?>
                    <div class="question-item" 
                        data-questao-id="<?php echo $questao['id_questao']; ?>"
                        data-respostas-a="<?php echo $questao['respostasA']; ?>"
                        data-respostas-b="<?php echo $questao['respostasB']; ?>"
                        data-respostas-c="<?php echo $questao['respostasC']; ?>"
                        data-respostas-d="<?php echo $questao['respostasD']; ?>">
                        <div class="question-header">
                            <div class="question-title">
                                <i class="fas fa-chevron-right"></i>
                                <div>
                                    <h4><?php echo htmlspecialchars($questao['titulo']); ?></h4>
                                    <div class="question-meta">
                                        Disciplina: <?php echo htmlspecialchars($questao['disciplina']); ?> • 
                                        <span class="question-acertos <?php echo $questao['acertos'] >= 70 ? 'text-green' : 'text-red'; ?>">
                                            <?php echo $questao['acertos']; ?>% de acertos
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="question-content" style="display: none;">
                            <div class="question-details">
                                <div class="chart-section">
                                    <h5>Distribuição das respostas:</h5>
                                    <canvas id="pie-chart-<?php echo $questao['id_questao']; ?>"></canvas>
                                </div>
                                <div class="alternatives-section">
                                    <h5>Alternativas:</h5>
                                    <br>
                                    <div class="alternatives-list">
                                        <?php foreach (['a', 'b', 'c', 'd'] as $letra): ?>
                                            <div class="alternative-item">
                                                <div class="alternative-header">
                                                    <div>
                                                        <span class="alternative-letter <?php echo strtoupper($letra) === $questao['alternativa_correta'] ? 'letter-correct' : ''; ?>">
                                                            <?php echo strtoupper($letra); ?>
                                                        </span>
                                                        <?php echo htmlspecialchars($questao['alternativa_' . $letra]); ?>
                                                        <?php if (strtoupper($letra) === $questao['alternativa_correta']): ?>
                                                            <span class="correct-label">(Correta)</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Lista de Alunos e Respostas -->
                            <div class="alunos-respostas">
                                <h5><i class="fas fa-users"></i> Respostas dos Alunos</h5>
                                <div class="alunos-lista">
                                    <?php if (!empty($questao['alunos_respostas_array'])): ?>
                                        <?php foreach ($questao['alunos_respostas_array'] as $resposta): ?>
                                            <div class="aluno-resposta <?php echo $resposta['acertou'] ? 'resposta-correta' : 'resposta-incorreta'; ?>">
                                                <span class="aluno-nome"><?php echo htmlspecialchars($resposta['nome']); ?></span>
                                                <span class="resposta-dada">
                                                    Respondeu: <strong><?php echo htmlspecialchars($resposta['resposta_dada']); ?></strong>
                                                    <?php if ($resposta['acertou']): ?>
                                                        <i class="fas fa-check"></i>
                                                    <?php else: ?>
                                                        <i class="fas fa-times"></i>
                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="sem-respostas">Nenhuma resposta registrada ainda.</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div id="alunos-view" class="card" style="display: none;">
            <?php if (empty($alunos)): ?>
                <div class="alert alert-info">Nenhum aluno encontrado.</div>
            <?php else: ?>
                <table class="students-table">
                    <thead>
                        <tr>
                            <th>Nome do Aluno</th>
                            <th class="center">Questões Respondidas</th>
                            <th class="center">Acertos</th>
                            <th class="center">Desempenho</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alunos as $aluno): 
                            $percentual = $aluno['questoes_respondidas'] > 0 
                                ? round(($aluno['acertos'] / $aluno['questoes_respondidas']) * 100) 
                                : 0;
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($aluno['nome']); ?></td>
                                <td class="center"><?php echo $aluno['questoes_respondidas']; ?></td>
                                <td class="center"><?php echo $aluno['acertos']; ?></td>
                                <td class="center">
                                    <div class="performance-bar">
                                        <div class="performance-fill <?php echo getPerformanceClass($percentual); ?>"
                                             style="width: <?php echo $percentual; ?>%">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Dados iniciais
        window.initialData = <?php echo json_encode($dados_iniciais); ?>;

        // Carregar dados da turma selecionada
        document.getElementById('disciplina-select').addEventListener('change', function() {
            const turmaId = this.value;
            if (!turmaId) return;

            fetch(`buscar.php?turma_id=${turmaId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Dados recebidos:', data);
                        atualizarDashboard(data);
                    } else {
                        console.error('Erro ao carregar dados:', data.error);
                    }
                })
                .catch(error => {
                    console.error('Erro na requisição:', error);
                });
        });
    </script>
    <script src="js/analiseQuestoes.js"></script>
</body>
</html>

<?php
function getPerformanceClass($percentual) {
    if ($percentual >= 70) return 'performance-good';
    if ($percentual >= 50) return 'performance-medium';
    return 'performance-poor';
}
?>