<?php
header('Content-Type: application/json');

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'cienciadb';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Buscar o ID da trilha de ligações químicas
    $stmt = $conn->prepare("SELECT id_trilha FROM trilhas WHERE nome_trilha LIKE '%Ligações Químicas%'");
    $stmt->execute();
    $trilha = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$trilha) {
        throw new Exception('Trilha de Ligações Químicas não encontrada');
    }
    
    $id_trilha = $trilha['id_trilha'];
    
    // Buscar questões do banco de dados
    $stmt = $conn->prepare("
        SELECT q.*, t.nome_trilha 
        FROM questao q 
        JOIN trilhas t ON q.id_trilha = t.id_trilha 
        WHERE q.id_trilha = :id_trilha 
        ORDER BY q.id_questao
    ");
    $stmt->bindParam(':id_trilha', $id_trilha);
    $stmt->execute();
    
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($questions)) {
        throw new Exception('Nenhuma questão encontrada para esta trilha');
    }
    
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
    
    echo json_encode(array(
        'success' => true,
        'title' => 'Atividade de Ligações Químicas',
        'questions' => $formattedQuestions
    ));
    
} catch(Exception $e) {
    http_response_code(500);
    echo json_encode(array(
        'success' => false,
        'error' => $e->getMessage()
    ));
}
?> 