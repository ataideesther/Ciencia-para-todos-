<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cienciadb";

$conexao = new mysqli($servername, $username, $password, $dbname);

if ($conexao->connect_errno) {
    echo "Failed to connect to MySQL: " . $conexao->connect_error;
    exit();
} else {
    $email = $conexao->real_escape_string($_POST['email']);
    //if(){
    $senha = $conexao->real_escape_string($_POST['senha']);

    $sql = "SELECT * FROM cadastro
        WHERE email = '$email' AND senha = '$senha' AND id_professor = 1";
   
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows == 1) {
        $row = $resultado->fetch_array();
        $_SESSION['id'] = $row[0];
        $_SESSION['nome'] = $row[1];
        $_SESSION['tipo'] = 'professor';
        $conexao->close();

        header('Location: paginaInicialProf.php', true, 301);
        exit();
    } else {
        $conexao->close();
        header('Location: index.php', true, 301);
    }
}
//}
?>