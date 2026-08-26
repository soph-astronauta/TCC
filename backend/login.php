<?php

$dados = json_decode(file_get_contents("php://input"), true);

$email = $dados["email"];
$senha = $dados["senha"];

// consultar banco...

echo json_encode([
    "sucesso" => true
]);