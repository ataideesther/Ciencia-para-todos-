<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cienciadb";

    $conexao = new mysqli($servername, $username, $password, $dbname);

    if ($conexao->connect_error) {
        die("Conexão falhou: " . $conexao->connect_error);
    } else {
        // Arrays dos inputs
        $nomes = $_POST['nome'];

        for ($i = 0; $i < count($nomes); $i++) {
            // Limpa e valida cada entrada
            $nome = $conexao->real_escape_string(trim($nomes[$i]));

            // Evita inserir linhas vazias
            if ($nome === '') {
                continue;
            }

            // Inserir apenas o nome, deixando o banco gerar o id_aluno automaticamente
            $sql = "INSERT INTO `alunosnaturma` (`nome`) VALUES ('$nome')";

            if ($conexao->query($sql) === TRUE) {
                echo "Novo aluno registrado: $nome<br>";
            } else {
                echo "Erro: " . $sql . "<br>" . $conexao->error;
            }
        }

        $conexao->close();
        header('Location: alunosNaTurma.php', true, 301);
        exit;
    }
} else {
    header('Location: alunosNaTurma.php', true, 301);
    exit;
}
?>
