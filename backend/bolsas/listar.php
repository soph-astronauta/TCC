<?php

header("Content-Type: application/json; charset=UTF-8");

require_once "../conexao.php";

try {

    $sql = "
        SELECT
            id_bolsa,
            nome,
            descricao,
            percentual_desconto,
            data_inicio,
            data_fim,
            id_curso,
        FROM bolsas_estudo
        ORDER BY data_inicio DESC
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $bolsas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "sucesso" => true,
        "bolsas_estudo" => $bolsas_estudo
    ]);

} catch(PDOException $e) {

    http_response_code(500);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro ao buscar bolsas."
    ]);
}
