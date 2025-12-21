<?php
// gravar_turma.php

session_start(); // Se necessário, manter para uso futuro

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cienciadb";

$conexao = new mysqli($servername, $username, $password, $dbname);

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Coleta os dados do POST
$nome_turma = $conexao->real_escape_string(trim($_POST['nome_turma'] ?? ''));
$curso = $conexao->real_escape_string(trim($_POST['curso'] ?? ''));
$professor = $conexao->real_escape_string(trim($_POST['cadastro'] ?? ''));
$alunos = $_POST['aluno_id'] ?? [];

// Validação básica
if ($nome_turma === '' || $curso === '' || $professor === '' || empty($alunos)) {
    echo "Preencha todos os campos obrigatórios.";
    exit;
}

// Insere a turma
$sqlTurma = "INSERT INTO turmas (nome_turma, curso, professor) VALUES ('$nome_turma', '$curso', '$professor')";

if ($conexao->query($sqlTurma) === TRUE) {
    $id_turma = $conexao->insert_id;

    // Atualiza os alunos com a nova turma
    foreach ($alunos as $aluno_id) {
        $aluno_id = (int) $aluno_id;
        if ($aluno_id > 0) {
            $sqlAtualizaAluno = "UPDATE cadastro SET id_turmas = '$id_turma' WHERE id = '$aluno_id'";
            $conexao->query($sqlAtualizaAluno);
        }
    }

    $conexao->close();
    header('Location: criarTurma.php?sucesso=1');
    exit;

} else {
    echo "Erro ao criar a turma: " . $conexao->error;
}
?>