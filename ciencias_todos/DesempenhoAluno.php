<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();

require_once 'conexao.php';

// Processa formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['salvar_conceito'])) {
    $id_aluno = $_POST['id_aluno'];
    $id_trilha = $_POST['id_trilha'];
    $conceito = $_POST['conceito'];
    
    try {
        // Verifica se já existe
        $sql_check = "SELECT id FROM desempenho WHERE id_aluno = ? AND id_trilha = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$id_aluno, $id_trilha]);
        
        if ($stmt_check->fetch()) {
            $sql = "UPDATE desempenho SET conceito = ? WHERE id_aluno = ? AND id_trilha = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$conceito, $id_aluno, $id_trilha]);
        } else {
            $sql = "INSERT INTO desempenho (nome, conceito, id_aluno, id_trilha) 
                    SELECT c.nome, ?, ?, ? FROM cadastro c WHERE c.id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$conceito, $id_aluno, $id_trilha, $id_aluno]);
        }
        
        $_SESSION['mensagem'] = "Conceito salvo com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['erro'] = "Erro: " . $e->getMessage();
    }
    
    header("Location: ".$_SERVER['PHP_SELF']."?id_turma=".$_GET['id_turma']);
    exit();
}

// Busca turmas
$turmas = $conn->query("SELECT * FROM turmas")->fetchAll();

// Busca trilhas
$trilhas = $conn->query("SELECT * FROM trilhas")->fetchAll();

// Busca alunos se turma selecionada
$alunos = [];
$historico = [];
if (isset($_GET['id_turma'])) {
    $id_turma = $_GET['id_turma'];
    
    // Consulta alunos corrigida
    $stmt_alunos = $conn->prepare("SELECT * FROM cadastro WHERE id_turmas = ? AND id_professor = 0");
    $stmt_alunos->execute([$id_turma]);
    $alunos = $stmt_alunos->fetchAll();
    
    // Consulta histórico corrigida
    $stmt_historico = $conn->prepare("SELECT d.*, t.nome_trilha FROM desempenho d
                     JOIN cadastro c ON d.id_aluno = c.id
                     JOIN trilhas t ON d.id_trilha = t.id_trilha
                     WHERE c.id_turmas = ? ORDER BY d.id_aluno, d.id_trilha");
    $stmt_historico->execute([$id_turma]);
    $historico = $stmt_historico->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
     <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="css/desempenhodosalunos.css">
  <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
  <title>Ciência para todos</title>
</head>
<body>
    <?php include_once('menuProfessor.php'); ?>
    <div class="container">
        <h1>Desempenho dos Alunos</h1>
        
        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="alert success"><?= $_SESSION['mensagem'] ?></div>
            <?php unset($_SESSION['mensagem']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['erro'])): ?>
            <div class="alert error"><?= $_SESSION['erro'] ?></div>
            <?php unset($_SESSION['erro']); ?>
        <?php endif; ?>
        
        <form method="get">
            <div class="form-group">
                <label for="id_turma">Selecione a Turma:</label>
                <select name="id_turma" id="id_turma" required>
                    <option value="">-- Selecione --</option>
                    <?php foreach ($turmas as $turma): ?>
                        <option value="<?= $turma['id_turma'] ?>" 
                            <?= isset($_GET['id_turma']) && $_GET['id_turma'] == $turma['id_turma'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($turma['nome_turma']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn">Carregar Alunos</button>
        </form>
        
        <?php if (!empty($alunos)): ?>
            <div class="alunos-container">
                <h2>Alunos da Turma</h2>
                
                <?php foreach ($alunos as $aluno): ?>
                    <div class="aluno-card">
                        <h3><?= htmlspecialchars($aluno['nome']) ?></h3>
                        
                        <form method="post">
                            <input type="hidden" name="id_aluno" value="<?= $aluno['id'] ?>">
                            
                            <div class="form-group">
                                <label>Trilha:</label>
                                <select name="id_trilha" required>
                                    <option value="">-- Selecione --</option>
                                    <?php foreach ($trilhas as $trilha): ?>
                                        <option value="<?= $trilha['id_trilha'] ?>">
                                            <?= htmlspecialchars($trilha['nome_trilha']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Conceito:</label>
                                <select name="conceito" required>
                                    <option value="">-- Selecione --</option>
                                    <option value="A">A - Excelente</option>
                                    <option value="B">B - Bom</option>
                                    <option value="C">C - Regular</option>
                                </select>
                            </div>
                            
                            <button type="submit" name="salvar_conceito" class="btn">Salvar Conceito</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="historico-container">
                <h2>Histórico de Conceitos</h2>
                
                <?php if (!empty($historico)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Aluno</th>
                                <th>Trilha</th>
                                <th>Conceito</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historico as $registro): ?>
                                <tr>
                                    <td><?= htmlspecialchars($registro['nome']) ?></td>
                                    <td><?= htmlspecialchars($registro['nome_trilha']) ?></td>
                                    <td><?= htmlspecialchars($registro['conceito']) ?></td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="id_aluno" value="<?= $registro['id_aluno'] ?>">
                                            <input type="hidden" name="id_trilha" value="<?= $registro['id_trilha'] ?>">
                                            <select name="conceito" onchange="this.form.submit()">
                                                <option value="A" <?= $registro['conceito'] == 'A' ? 'selected' : '' ?>>A</option>
                                                <option value="B" <?= $registro['conceito'] == 'B' ? 'selected' : '' ?>>B</option>
                                                <option value="C" <?= $registro['conceito'] == 'C' ? 'selected' : '' ?>>C</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Nenhum conceito registrado.</p>
                <?php endif; ?>
            </div>
        <?php elseif (isset($_GET['id_turma'])): ?>
            <p>Nenhum aluno encontrado.</p>
        <?php endif; ?>
    </div>
    <script src="script.js"></script>
</body>
</html>