<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'cienciadb';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Verificar se a trilha existe
    $stmt = $conn->prepare("SELECT * FROM trilhas WHERE id_trilha = 6");
    $stmt->execute();
    $trilha = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "Informações da trilha:<br>";
    if ($trilha) {
        echo "ID: " . $trilha['id_trilha'] . "<br>";
        echo "Nome: " . $trilha['nome_trilha'] . "<br><br>";
    } else {
        echo "Trilha não encontrada!<br><br>";
    }
    
    // Verificar questões
    $stmt = $conn->prepare("
        SELECT q.*, t.nome_trilha 
        FROM questao q 
        JOIN trilhas t ON q.id_trilha = t.id_trilha 
        WHERE q.id_trilha = 6
    ");
    $stmt->execute();
    $questoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Questões encontradas: " . count($questoes) . "<br><br>";
    
    if (count($questoes) > 0) {
        echo "Detalhes das questões:<br>";
        foreach ($questoes as $questao) {
            echo "ID: " . $questao['id_questao'] . "<br>";
            echo "Enunciado: " . $questao['enunciado'] . "<br>";
            echo "Trilha: " . $questao['nome_trilha'] . "<br><br>";
        }
    }
    
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?> 