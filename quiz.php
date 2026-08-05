<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$resultado = $_POST['resultado'];

include "conexao.php";

$sql = "INSERT INTO leads
(nome,email,telefone,resultado)
VALUES
('$nome','$email','$telefone','$resultado')";

mysqli_query($conn,$sql);

header("Location: obrigado.php");

?>