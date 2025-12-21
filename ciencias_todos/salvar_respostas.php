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

// Iniciar o buffer de saída
ob_start();

try {
    session_start();
    
    // Verificar sessão
    if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'aluno') {
        throw new Exception('Acesso não autorizado');
    }

    // Verificar método da requisição
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método não permitido');
    }

    // Definir header de resposta JSON
    header('Content-Type: application/json; charset=utf-8');

    // Conectar ao banco com PDO
    $conn = new PDO("mysql:host=localhost;dbname=cienciadb", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Receber e validar dados
    $inputJSON = file_get_contents('php://input');
    if (empty($inputJSON)) {
        throw new Exception('Nenhum dado recebido');
    }

    $data = json_decode($inputJSON, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('JSON inválido: ' . json_last_error_msg());
    }

    if (!isset($data['respostas']) || !is_array($data['respostas']) || empty($data['respostas'])) {
        throw new Exception('Formato de dados inválido ou sem respostas');
    }
    
    // Iniciar transação
    $conn->beginTransaction();
    
    try {
        // Primeiro, deletar as respostas anteriores do aluno para as questões atuais
        $questoes_ids = implode(',', array_column($data['respostas'], 'id_questao'));
        $stmt = $conn->prepare("
            DELETE FROM resposta 
            WHERE id_aluno = :id_aluno 
            AND id_questao IN ($questoes_ids)
        ");
        $stmt->execute([':id_aluno' => $_SESSION['id']]);
        
        // Agora, inserir as novas respostas
        $stmt = $conn->prepare("
            INSERT INTO resposta 
            (id_aluno, id_questao, resposta_dada, data_resposta) 
            VALUES 
            (:id_aluno, :id_questao, :resposta_dada, NOW())
        ");
        
        $respostasSalvas = 0;
        foreach ($data['respostas'] as $resposta) {
            if (!isset($resposta['id_questao']) || !isset($resposta['resposta_dada'])) {
                continue;
            }
            
            $stmt->execute([
                ':id_aluno' => $_SESSION['id'],
                ':id_questao' => $resposta['id_questao'],
                ':resposta_dada' => $resposta['resposta_dada']
            ]);
            
            $respostasSalvas++;
        }
        
        // Calcular pontuação
        $stmt = $conn->prepare("
            SELECT COUNT(*) as total_corretas
            FROM resposta r
            JOIN questao q ON r.id_questao = q.id_questao
            WHERE r.id_aluno = :id_aluno
            AND r.resposta_dada = q.alternativa_correta
            AND r.id_questao IN ($questoes_ids)
        ");
        
        $stmt->execute([
            ':id_aluno' => $_SESSION['id']
        ]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $pontuacao = $result['total_corretas'];
        
        // Commit se tudo deu certo
        $conn->commit();
        
        // Limpar buffer e enviar resposta
        ob_clean();
        echo json_encode([
            'success' => true,
            'message' => "$respostasSalvas respostas salvas com sucesso!",
            'pontuacao' => $pontuacao,
            'aluno_id' => $_SESSION['id']
        ]);
        
    } catch (Exception $e) {
        $conn->rollBack();
        throw $e;
    }
    
} catch (PDOException $e) {
    logError("Erro PDO: " . $e->getMessage());
    http_response_code(500);
    ob_clean();
    echo json_encode([
        'success' => false,
        'error' => 'Erro no banco de dados: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    logError("Erro geral: " . $e->getMessage());
    http_response_code(400);
    ob_clean();
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

// Garantir que o buffer seja enviado e encerrado
ob_end_flush();
exit();
?>