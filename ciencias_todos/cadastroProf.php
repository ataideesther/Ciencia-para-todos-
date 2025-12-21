<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cienciadb";

$conexao = new mysqli($servername, $username, $password, $dbname);

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}else{
    $nome = $conexao -> real_escape_string($_POST['nome']);
	$email = $conexao -> real_escape_string($_POST['email']);
	$senha = $conexao -> real_escape_string($_POST['senha']);
    
    $sql = "INSERT INTO `cadastro` (`nome`, `email`, `senha`, `id_professor`) 
                VALUES ('$nome', '$email', '$senha', 1)";
    
        $resultado = $conexao->query($sql);
                    
        $conexao -> close();
        header('Location: index.php', true, 301);
}
    ?>