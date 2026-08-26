<?php
include "conexao.php";

$dados = json_decode(file_get_contents("php://input"), true);

$email = $dados["email"];
$senha = $dados["senha"];

echo json_encode([
    "sucesso" => true,
    "mensagem" => "Login realizado!"
]);

// Recebe os dados do formulário
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$resultado = $_POST['resultado'] ?? '';

// Prepara a instrução SQL com segurança contra SQL Injection
$stmt = $conn->prepare("INSERT INTO leads (nome, email, telefone, resultado) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nome, $email, $telefone, $resultado);

if ($stmt->execute()) {
    // Redireciona para a página de agradecimento
    header("Location: obrigado.php");
    exit();
} else {
    echo "Erro ao salvar os dados: " . $conn->error;
}

$stmt->close();
$conn->close();
?>