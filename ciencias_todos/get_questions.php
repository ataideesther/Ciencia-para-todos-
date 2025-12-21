<?php
header('Content-Type: application/json');

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'cienciadb';
$username = 'root';
$password = '';

$id_trilha = filter_input(INPUT_GET, 'id_trilha', FILTER_VALIDATE_INT, ['options' => ['default' => 1, 'min_range' => 1]]);

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obter o ID da trilha (você pode passar isso como parâmetro)
    $id_trilha = isset($_GET['id_trilha']) ? $_GET['id_trilha'] : 1;
    
    // Buscar questões do banco de dados
    $stmt = $conn->prepare("SELECT * FROM questao WHERE id_trilha = :id_trilha");
    $stmt->bindParam(':id_trilha', $id_trilha);
    $stmt->execute();
    
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Formatar as questões para o frontend
    $formattedQuestions = array();
    foreach ($questions as $question) {
        $formattedQuestions[] = array(
            'id' => $question['id_questao'],
            'text' => $question['enunciado'],
            'options' => array(
                array('id' => 'A', 'text' => $question['alternativa_a']),
                array('id' => 'B', 'text' => $question['alternativa_b']),
                array('id' => 'C', 'text' => $question['alternativa_c']),
                array('id' => 'D', 'text' => $question['alternativa_d'])
            ),
            'correctAnswer' => $question['alternativa_correta']
        );
    }
    
    // Buscar nome da trilha
    $stmt = $conn->prepare("SELECT nome_trilha FROM trilhas WHERE id_trilha = :id_trilha");
    $stmt->bindParam(':id_trilha', $id_trilha);
    $stmt->execute();
    $trilha = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode(array(
        'title' => $trilha['nome_trilha'],
        'questions' => $formattedQuestions
    ));
    
} catch(PDOException $e) {
    echo json_encode(array('error' => 'Erro ao conectar com o banco de dados: ' . $e->getMessage()));
}
?>