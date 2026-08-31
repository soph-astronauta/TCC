<?php

header("Content-Type: application/json; charset=utf-8");

require_once "../conexao.php";

$dados = json_decode(
    file_get_contents("php://input"),
    true
);

$usuario_id = $dados["usuario_id"] ?? null;
$postagem_id = $dados["postagem_id"] ?? null;

if (!$usuario_id || !$postagem_id) {

    http_response_code(400);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Dados inválidos."
    ]);

    exit;
}

try {

    // Verifica se já curtiu
    $sql = "
        SELECT id
        FROM curtidas
        WHERE usuario_id = :usuario_id
        AND postagem_id = :postagem_id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":usuario_id" => $usuario_id,
        ":postagem_id" => $postagem_id
    ]);

    $curtida = $stmt->fetch();

    if ($curtida) {

        // Remove curtida
        $sql = "
            DELETE FROM curtidas
            WHERE usuario_id = :usuario_id
            AND postagem_id = :postagem_id
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ":usuario_id" => $usuario_id,
            ":postagem_id" => $postagem_id
        ]);

        $curtiu = false;

    } else {

        // Adiciona curtida
        $sql = "
            INSERT INTO curtidas
            (usuario_id, postagem_id)
            VALUES
            (:usuario_id, :postagem_id)
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ":usuario_id" => $usuario_id,
            ":postagem_id" => $postagem_id
        ]);

        $curtiu = true;
    }

    // Conta curtidas
    $sql = "
        SELECT COUNT(*)
        FROM curtidas
        WHERE postagem_id = :postagem_id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":postagem_id" => $postagem_id
    ]);

    $total = $stmt->fetchColumn();

    echo json_encode([
        "sucesso" => true,
        "curtiu" => $curtiu,
        "total" => $total
    ]);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro ao curtir."
    ]);
}
