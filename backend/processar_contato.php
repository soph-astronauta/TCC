<?php

$conn = new mysqli("localhost", "root", "", "banco_interway");

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

$nome = trim($_POST["nome"] ?? "");
$email = trim($_POST["email"] ?? "");
$mensagem = trim($_POST["mensagem"] ?? "");

if ($nome === "" || $email === "" || $mensagem === "") {
    die("Preencha todos os campos.");
}

$sql = "INSERT INTO contatos (nome, email, mensagem)
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $mensagem);

if ($stmt->execute()) {
    echo "Mensagem enviada com sucesso!";
} else {
    echo "Erro ao enviar a mensagem.";
}

$stmt->close();
$conn->close();
?>
