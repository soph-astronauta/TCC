<?php

header("Content-Type: application/json; charset=UTF-8");

require_once "../conexao.php";

try {

    $sql = "
        SELECT
            id,
            universidade,
            pais,
            descricao,
            imagem,
            site_oficial,
            nome_bolsa,
            nivel,
            area,
            data_criacao
        FROM bolsas
        ORDER BY data_criacao DESC
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $bolsas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "sucesso" => true,
        "bolsas" => $bolsas
    ]);

} catch(PDOException $e) {

    http_response_code(500);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro ao buscar bolsas."
    ]);
}
