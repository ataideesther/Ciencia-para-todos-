<?php
header('Content-Type: application/json');

$conn = new mysqli('127.0.0.1', 'root', '', 'cienciadb');
if ($conn->connect_error) {
    die(json_encode(['error' => "Conexão falhou: " . $conn->connect_error]));
}

$result = $conn->query("SELECT id_trilha, nome_trilha FROM trilhas");
$trilhas = [];

while ($row = $result->fetch_assoc()) {
    $trilhas[] = [
        'id_trilha' => $row['id_trilha'],
        'nome_trilha' => $row['nome_trilha']
    ];
}

echo json_encode($trilhas);
?>