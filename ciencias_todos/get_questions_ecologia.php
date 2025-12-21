<?php
// Desabilitar a exibição de erros para o cliente
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Função para log
function logError($message) {
    $logFile = __DIR__ . '/error_log.txt';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

header('Content-Type: application/json');

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'cienciadb';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // ID da trilha de ecologia
    $id_trilha = 6;
    
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
        throw new Exception('Nenhuma questão encontrada para ecologia');
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
        'title' => 'Atividade de Ecologia',
        'questions' => $formattedQuestions
    ));
    
} catch(PDOException $e) {
    logError("Erro PDO: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(array(
        'success' => false,
        'error' => 'Erro no banco de dados: ' . $e->getMessage()
    ));
} catch(Exception $e) {
    logError("Erro geral: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(array(
        'success' => false,
        'error' => $e->getMessage()
    ));
}
?> 