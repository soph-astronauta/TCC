<?php

header("Content-Type: application/json; charset=utf-8");

require_once "../conexao.php";

$dados = json_decode(
    file_get_contents("php://input"),
    true
);

$usuario_id = $dados["usuario_id"] ?? null;
$titulo = trim($dados["titulo"] ?? "");
$pais = trim($dados["pais"] ?? "");
$texto = trim($dados["texto"] ?? "");
$imagem = trim($dados["imagem"] ?? "");

if (!$usuario_id || !$titulo || !$pais || !$texto) {

    http_response_code(400);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Preencha todos os campos."
    ]);

    exit;
}

try {

    $sql = "INSERT INTO postagens
            (usuario_id, titulo, pais, texto, imagem)
            VALUES
            (:usuario_id, :titulo, :pais, :texto, :imagem)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":usuario_id" => $usuario_id,
        ":titulo" => $titulo,
        ":pais" => $pais,
        ":texto" => $texto,
        ":imagem" => $imagem
    ]);

    echo json_encode([
        "sucesso" => true,
        "mensagem" => "Relato publicado!",
        "id" => $pdo->lastInsertId()
    ]);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro ao publicar."
    ]);
}
