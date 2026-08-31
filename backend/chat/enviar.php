<?php

header("Content-Type: application/json; charset=UTF-8");

require_once "../conexao.php";

$dados = json_decode(
    file_get_contents("php://input"),
    true
);

$usuario_id = $dados["usuario_id"] ?? null;
$mensagem = trim($dados["mensagem"] ?? "");

if (!$usuario_id || $mensagem === "") {

    http_response_code(400);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Dados incompletos."
    ]);

    exit;
}


/* ==========================================
   GERAR RESPOSTA
========================================== */

$texto = strtolower($mensagem);

if (strpos($texto, "canadá") !== false) {

    $resposta =
        "🇨🇦 O Canadá é um dos destinos mais procurados "
        . "para intercâmbio e possui oportunidades de estudo.";

} elseif (
    strpos($texto, "inglês") !== false ||
    strpos($texto, "ingles") !== false
) {

    $resposta =
        "📚 Você pode estudar inglês em países como "
        . "Canadá, Estados Unidos, Inglaterra, Irlanda "
        . "e Austrália.";

} elseif (strpos($texto, "bolsa") !== false) {

    $resposta =
        "🎓 Existem diversas bolsas internacionais. "
        . "Na Interway você pode consultar oportunidades "
        . "em universidades de diferentes países.";

} elseif (
    strpos($texto, "preço") !== false ||
    strpos($texto, "custo") !== false
) {

    $resposta =
        "💰 O custo de um intercâmbio depende do país, "
        . "cidade, duração e tipo de programa.";

} elseif (
    strpos($texto, "oi") !== false ||
    strpos($texto, "olá") !== false ||
    strpos($texto, "ola") !== false
) {

    $resposta =
        "Olá! 👋 Posso ajudar você com países, bolsas, "
        . "cursos e intercâmbio.";

} else {

    $resposta =
        "🤔 Posso ajudar com informações sobre países, "
        . "bolsas, cursos e destinos de intercâmbio.";

}


/* ==========================================
   SALVAR CONVERSA
========================================== */

try {

    $sql = "
        INSERT INTO mensagens_chat
        (
            usuario_id,
            mensagem,
            resposta
        )
        VALUES
        (
            :usuario_id,
            :mensagem,
            :resposta
        )
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":usuario_id" => $usuario_id,
        ":mensagem" => $mensagem,
        ":resposta" => $resposta
    ]);


    echo json_encode([

        "sucesso" => true,

        "resposta" => $resposta

    ]);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([

        "sucesso" => false,

        "mensagem" => "Erro ao salvar a conversa."

    ]);

}
