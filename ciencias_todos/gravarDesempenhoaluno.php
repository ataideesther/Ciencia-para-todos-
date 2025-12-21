<?php
/*    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cienciadb";

        $conexao = new mysqli($servername, $username, $password, $dbname);

        if ($conexao->connect_error) {
            die("Conexão falhou: " . $conexao->connect_error);
        }else{
            $nome = $conexao -> real_escape_string($_POST["nome"]);
            $trilha = $conexao -> real_escape_string($_POST["trilha"]);
            $conceito = $conexao -> real_escape_string($_POST["conceito"]);

            $sql = "INSERT INTO `desempenho` (`nome`, `trilha`, `conceito`, `id_aluno`) 
            VALUES ('$nome', '$trilha', '$conceito', 0)";

            $resultado = $conexao->query($sql);
                        
            $conexao -> close();
            header('Location: desempenhoAluno.php', true, 301);
        }
    } else {
        header('Location: desempenhoAluno.php', true, 301);
    }
*/
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
        $trilhas = $_POST['trilha'];
        $conceitos = $_POST['conceito'];

        for ($i = 0; $i < count($nomes); $i++) {
            // Limpa e valida cada entrada
            $nome = $conexao->real_escape_string(trim($nomes[$i]));
            $trilha = $conexao->real_escape_string(trim($trilhas[$i]));
            $conceito = $conexao->real_escape_string(trim($conceitos[$i]));

            // Evita inserir linhas vazias
            if ($nome === '' && $trilha === '' && $conceito === '') {
                continue;
            }

            $sql = "INSERT INTO `desempenho` (`nome`, `id_trilha`, `conceito`, `id_aluno`) 
                    VALUES ('$nome', '$trilha', '$conceito', 0)";

            $conexao->query($sql);
        }

        $conexao->close();
        header('Location: desempenhoAluno.php', true, 301);
        exit;
    }
} else {
    header('Location: desempenhoAluno.php', true, 301);
    exit;
}
?>