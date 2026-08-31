<?php

header("Content-Type: application/json; charset=utf-8");

require_once "conexao.php";

$dados = json_decode(
    file_get_contents("php://input"),
    true
);

$nome = trim($dados["nome"] ?? "");
$email = trim($dados["email"] ?? "");
$mensagem = trim($dados["mensagem"] ?? "");

if ($nome === "" || $email === "" || $mensagem === "") {

    http_response_code(400);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Preencha todos os campos."
    ]);

    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    http_response_code(400);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "E-mail inválido."
    ]);

    exit;
}

try {

    $sql = "INSERT INTO contatos
            (nome, email, mensagem)
            VALUES
            (:nome, :email, :mensagem)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":nome" => $nome,
        ":email" => $email,
        ":mensagem" => $mensagem
    ]);

    echo json_encode([
        "sucesso" => true,
        "mensagem" => "Mensagem enviada com sucesso!"
    ]);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro ao salvar mensagem."
    ]);
}
