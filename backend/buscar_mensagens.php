<?php
// buscar_mensagens.php
header('Content-Type: application/json; charset=utf-8');
require_once 'conexao.php';

// Permite buscar apenas mensagens novas a partir de um certo ID (otimização)
$ultimo_id = isset($_GET['ultimo_id']) ? (int)$_GET['ultimo_id'] : 0;

$sql = "SELECT 
            m.id_mensagem,
            m.id_usuario,
            m.mensagem,
            DATE_FORMAT(m.data_envio, '%H:%i') as hora,
            u.nome,
            u.pais_intercambio
        FROM mensagens_chat m
        INNER JOIN usuarios_chat u ON m.id_usuario = u.id_usuario
        WHERE m.id_mensagem > ?
        ORDER BY m.id_mensagem ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ultimo_id);
$stmt->execute();
$resultado = $stmt->get_result();

$mensagens = [];
while ($linha = $resultado->fetch_assoc()) {
    $mensagens[] = [
        'id' => (int)$linha['id_mensagem'],
        'id_usuario' => (int)$linha['id_usuario'],
        'nome' => $linha['nome'],
        'pais' => $linha['pais_intercambio'],
        'texto' => $linha['mensagem'],
        'hora' => $linha['hora']
    ];
}

echo json_encode($mensagens);

$stmt->close();
$conn->close();