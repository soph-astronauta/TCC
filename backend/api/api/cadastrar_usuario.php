<?php

header("Content-Type: application/json");

require_once "conexao.php";

$dados = json_decode(file_get_contents("php://input"), true);

$nome = $dados["nome"];
$email = $dados["email"];

$sql = "INSERT INTO usuarios (nome, email)
        VALUES (:nome, :email)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":nome" => $nome,
    ":email" => $email
]);

echo json_encode([
    "mensagem" => "Usuário cadastrado com sucesso"
]);