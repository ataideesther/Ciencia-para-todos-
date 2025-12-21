<?php
session_start(); // Inicia a sessão

// Verifique se o id_aluno existe na sessão
if (!isset($_SESSION['id_aluno'])) {
    die('ID do aluno não encontrado na sessão.');
}

$hostname = "127.0.0.1";
$user = "root";
$password = "";
$database = "cienciadb";

$conexao = new mysqli($hostname, $user, $password, $database);

// Verifique se a conexão foi bem-sucedida
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Prepare a consulta SQL com parâmetros
$sql = "SELECT * FROM `alunosnaturma` WHERE id_aluno = ?";
$stmt = $conexao->prepare($sql);

// Verifique se a consulta foi preparada corretamente
if ($stmt === false) {
    die("Erro ao preparar a consulta: " . $conexao->error);
}

$stmt->bind_param("i", $_SESSION['id_aluno']); // "i" para integer
$stmt->execute();
$resultado = $stmt->get_result();

// Exiba os dados
echo '<hr>';
while ($row = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
    echo 'Nome: ' . htmlspecialchars($row['nome']) . '<br>';
    echo 'Enviado por: ' . htmlspecialchars($row['enviado_por']) . ' no dia: ' . htmlspecialchars($row['data_enviado']) . '.';
    echo '<hr>';
}

$stmt->close();
$conexao->close();
?>
<br>
<a href="sair.php" class='sair'>Sair</a>
