<?php

header("Content-Type: application/json");

require_once "conexao.php";

$sql = "SELECT id, nome, email FROM usuarios";

$stmt = $pdo->query($sql);

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($usuarios);