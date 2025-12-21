<?php
session_start();

$conexao = new mysqli("localhost", "root", "", "cienciadb");

if ($conexao->connect_errno) {
    die("Erro de conexão: " . $conexao->connect_error);
}

$email = $conexao->real_escape_string($_POST['email']);
$senha = $conexao->real_escape_string($_POST['senha']);

$sql = "SELECT id, nome FROM cadastro 
        WHERE email = '$email' 
        AND senha = '$senha'
        AND id_professor = 0"; // Garante que é aluno

$resultado = $conexao->query($sql);

if ($resultado->num_rows === 1) {
    $aluno = $resultado->fetch_assoc();
    
    $_SESSION = [
        'id' => $aluno['id'],
        'nome' => $aluno['nome'],
        'tipo' => 'aluno',
        'logado' => true
    ];
    
    header("Location: paginaInicialAluno.php");
    exit();
} else {
    header("Location: alunoLogin.php?erro=1");
    exit();
}
?>