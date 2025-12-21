<?php
$hostname = "127.0.0.1";
$user = "root";
$password = "";
$database = "cienciadb";

$conexao = new mysqli($hostname, $user, $password, $database);

$sql = "SELECT * FROM `cienciadb`.`desempenho`
        WHERE id_aluno = '".$_SESSION['id_aluno']."';";

$resultado = $conexao->query($sql);

echo '<hr>';

while($row = mysqli_fetch_array($resultado)){
    echo $row[1];
    echo '<br>';
    echo 'Enviado por: '.$row[3].' no dia: '.$row[2].'.';
    echo '<br>';
    echo '<hr>';
    echo '<br>';
}

$conexao->close();
?>
<br>
<a href="sair.php" class='sair'>Sair</a>