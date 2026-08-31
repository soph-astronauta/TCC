<?php

header("Content-Type: application/json; charset=utf-8");

require_once "conexao.php";

$dados = json_decode(
    file_get_contents("php://input"),
    true
);

$email = trim($dados["email"] ?? "");
$senha = $dados["senha"] ?? "";

if ($email === "" || $senha === "") {

    http_response_code(400);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Informe o e-mail e a senha."
    ]);

    exit;
}

$sql = "SELECT id, nome, email, senha
        FROM usuarios
        WHERE email = :email
        LIMIT 1";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":email" => $email
]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario || !password_verify($senha, $usuario["senha"])) {

    http_response_code(401);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "E-mail ou senha incorretos."
    ]);

    exit;
}

echo json_encode([
    "sucesso" => true,
    "mensagem" => "Login realizado com sucesso!",
    "usuario" => [
        "id" => $usuario["id"],
        "nome" => $usuario["nome"],
        "email" => $usuario["email"]
    ]
]);
