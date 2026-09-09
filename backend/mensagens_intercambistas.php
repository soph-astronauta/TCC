<?php
// enviar_mensagem.php
header('Content-Type: application/json; charset=utf-8');
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['sucesso' => false, 'erro' => 'Método não permitido']);
    exit;
}

// Lê os dados JSON enviados pelo JavaScript
$dados = json_decode(file_get_contents('php://input'), true);

$id_usuario = filter_var($dados['id_usuario'] ?? 3, FILTER_VALIDATE_INT); // padrão 3 ("Você")
$mensagem = trim($dados['mensagem'] ?? '');

if (empty($mensagem)) {
    echo json_encode(['sucesso' => false, 'erro' => 'Mensagem vazia']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO mensagens_chat (id_usuario, mensagem) VALUES (?, ?)");
$stmt->bind_param("is", $id_usuario, $mensagem);

if ($stmt->execute()) {
    echo json_encode([
        'sucesso' => true,
        'id_inserido' => $stmt->insert_id
    ]);
} else {
    http_response_code(500);
    echo json_encode(['sucesso' => false, 'erro' => $stmt->error]);
}

$stmt->close();
$conn->close();