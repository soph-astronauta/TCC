<?php

header("Content-Type: application/json; charset=utf-8");

require_once "../conexao.php";

try {

    $sql = "
        SELECT
            p.id,
            p.titulo,
            p.pais,
            p.texto,
            p.imagem,
            p.data_criacao,
            u.id AS usuario_id,
            u.nome,

            (
                SELECT COUNT(*)
                FROM curtidas c
                WHERE c.postagem_id = p.id
            ) AS curtidas

        FROM postagens p

        INNER JOIN usuarios u
            ON u.id = p.usuario_id

        ORDER BY p.data_criacao DESC
    ";

    $stmt = $pdo->query($sql);

    $postagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "sucesso" => true,
        "postagens" => $postagens
    ]);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro ao carregar publicações."
    ]);
}
