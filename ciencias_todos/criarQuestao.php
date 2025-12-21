<?php
header('Content-Type: application/json');

// Configurações de conexão com o banco de dados
$host = '127.0.0.1';
$dbname = 'cienciadb';
$username = 'root'; // Substitua pelo seu usuário do MySQL
$password = ''; // Substitua pela sua senha do MySQL

try {
    // Conexão com o banco de dados
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Receber os dados do formulário
    $enunciado = $_POST['enunciado'];
    $alternativa_correta = $_POST['correta'];
    $alternativa_a = $_POST['alternativa_a'];
    $alternativa_b = $_POST['alternativa_b'];
    $alternativa_c = $_POST['alternativa_c'];
    $alternativa_d = $_POST['alternativa_d'];
    $id_trilha = $_POST['trilha'];

    // Preparar a query SQL para inserir a questão
    $stmt = $conn->prepare("INSERT INTO questao 
                          (enunciado, alternativa_correta, alternativa_a, alternativa_b, alternativa_c, alternativa_d, id_trilha) 
                          VALUES 
                          (:enunciado, :alternativa_correta, :alternativa_a, :alternativa_b, :alternativa_c, :alternativa_d, :id_trilha)");

    // Executar a query com os parâmetros
    $stmt->execute([
        ':enunciado' => $enunciado,
        ':alternativa_correta' => $alternativa_correta,
        ':alternativa_a' => $alternativa_a,
        ':alternativa_b' => $alternativa_b,
        ':alternativa_c' => $alternativa_c,
        ':alternativa_d' => $alternativa_d,
        ':id_trilha' => $id_trilha
    ]);

    // Retornar sucesso
    echo json_encode(['success' => true, 'message' => 'Questão criada com sucesso!']);

} catch(PDOException $e) {
    // Retornar erro em caso de falha
    echo json_encode(['success' => false, 'message' => 'Erro ao criar questão: ' . $e->getMessage()]);
}
?>