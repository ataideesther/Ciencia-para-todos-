<?php
header('Content-Type: application/json');

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'cienciadb';
$username = 'root';
$password = '';

// ID fixo para a trilha de Modelos Atômicos
$id_trilha = 2;

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Buscar questões do banco de dados
    $stmt = $conn->prepare("SELECT * FROM questao WHERE id_trilha = :id_trilha");
    $stmt->bindParam(':id_trilha', $id_trilha);
    $stmt->execute();
    
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Debug: Verificar os dados do banco
    error_log("Dados do banco: " . print_r($questions, true));
    
    // Formatar as questões para o frontend
    $formattedQuestions = array();
    foreach ($questions as $question) {
        // Debug: Verificar cada questão
        error_log("Processando questão ID: " . $question['id_questao']);
        error_log("Alternativa correta: " . $question['alternativa_correta']);
        
        $formattedQuestions[] = array(
            'id' => $question['id_questao'],
            'text' => $question['enunciado'],
            'options' => array(
                array('id' => 'A', 'text' => $question['alternativa_a']),
                array('id' => 'B', 'text' => $question['alternativa_b']),
                array('id' => 'C', 'text' => $question['alternativa_c']),
                array('id' => 'D', 'text' => $question['alternativa_d'])
            ),
            'correctAnswer' => trim($question['alternativa_correta']) // Garantir que não há espaços extras
        );
    }
    
    // Debug: Verificar questões formatadas
    error_log("Questões formatadas: " . print_r($formattedQuestions, true));
    
    // Buscar nome da trilha
    $stmt = $conn->prepare("SELECT nome_trilha FROM trilhas WHERE id_trilha = :id_trilha");
    $stmt->bindParam(':id_trilha', $id_trilha);
    $stmt->execute();
    $trilha = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $response = array(
        'title' => $trilha['nome_trilha'],
        'questions' => $formattedQuestions
    );
    
    // Debug: Verificar resposta final
    error_log("Resposta final: " . print_r($response, true));
    
    echo json_encode($response);
    
} catch(PDOException $e) {
    error_log("Erro no banco de dados: " . $e->getMessage());
    echo json_encode(array('error' => 'Erro ao conectar com o banco de dados: ' . $e->getMessage()));
}
?>