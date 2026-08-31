<?php

header("Content-Type: application/json; charset=UTF-8");

require_once "../conexao.php";

$usuario_id = $_GET["usuario_id"] ?? null;

if (!$usuario_id) {

    http_response_code(400);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Usuário não informado."
    ]);

    exit;
}

try {

    $sql = "
        SELECT
            id,
            mensagem,
            resposta,
            data_envio
        FROM mensagens_chat
        WHERE usuario_id = :usuario_id
        ORDER BY data_envio ASC
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":usuario_id" => $usuario_id
    ]);

    $mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([

        "sucesso" => true,

        "mensagens" => $mensagens

    ]);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([

        "sucesso" => false,

        "mensagem" => "Erro ao carregar histórico."

    ]);

}
