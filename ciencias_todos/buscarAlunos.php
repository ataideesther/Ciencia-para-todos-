<?php
header('Content-Type: application/json');

$conn = new mysqli('127.0.0.1', 'root', '', 'cienciadb');
if ($conn->connect_error) {
    die(json_encode(['error' => "Conexão falhou: " . $conn->connect_error]));
}

$turmaId = $_GET['turma'] ?? 0;

// Corrigido: usando id_turmas (como está na tabela) e verificando id_professor = 0
$query = $conn->prepare("SELECT id, nome FROM cadastro WHERE id_turmas = ? AND id_professor = 0");
$query->bind_param('i', $turmaId);
$query->execute();
$result = $query->get_result();

$alunos = [];
while ($row = $result->fetch_assoc()) {
    $alunos[] = [
        'id' => $row['id'],
        'nome' => $row['nome']
    ];
}

echo json_encode($alunos);
?>