<?php

session_start();


// =====================================================
// CONEXÃO COM O BANCO
// =====================================================

$host = "localhost";
$usuario = "root";
$senhaBanco = "";
$banco = "banco_interway";

$conn = new mysqli(
    $host,
    $usuario,
    $senhaBanco,
    $banco
);

if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");


// =====================================================
// LOGIN
// =====================================================

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $senha = trim($_POST["senha"] ?? "");


    if (empty($email) || empty($senha)) {

        $erro = "Preencha todos os campos.";

    } else {

        // Procura o usuário pelo e-mail
        $sql = "
            SELECT
                senha,
                id_usuario,
                email,
                nome
            FROM usuário
            WHERE email = ?
            LIMIT 1
        ";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {

            $erro = "Erro ao preparar a consulta.";

        } else {

            $stmt->bind_param("s", $email);

            $stmt->execute();

            $resultado = $stmt->get_result();


            if ($resultado->num_rows === 1) {

                $usuario = $resultado->fetch_assoc();


                // Verifica a senha
                if ($senha === $usuario["senha"]) {

                    // Guarda os dados na sessão
                    $_SESSION["logado"] = true;

                    $_SESSION["id_usuario"] =
                        $usuario["id_usuario"];

                    $_SESSION["email"] =
                        $usuario["email"];

                    $_SESSION["nome"] =
                        $usuario["nome"];


                    // Redireciona para a página inicial
                    header("Location: index.php");

                    exit;

                } else {

                    $erro = "E-mail ou senha incorretos.";

                }

            } else {

                $erro = "E-mail ou senha incorretos.";

            }

            $stmt->close();
        }
    }
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Login - Interway</title>


<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet"
>


<style>

:root{

    --blue:#0B4DDB;

    --blue-dark:#0738A5;

    --gray:#667085;

    --dark:#101828;

    --light:#F5F8FF;

    --red:#dc2626;

}

*{

    margin:0;

    padding:0;

    box-sizing:border-box;

    font-family:'Poppins',sans-serif;

}

body{

    background:
        linear-gradient(
            135deg,
            #eaf1ff,
            #f5f8ff
        );

    min-height:100vh;

    display:flex;

    flex-direction:column;

}


/* ==========================================
   TOPBAR
========================================== */

.topbar{

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:12px 20px;

    background:white;

    box-shadow:
        0 10px 25px
        rgba(0,0,0,.08);

}

.nav-buttons{

    display:flex;

    gap:10px;

}

.nav-btn{

    text-decoration:none;

    padding:10px 16px;

    border-radius:12px;

    font-weight:600;

}

.back{

    background:#e5e7eb;

    color:#111;

}

.home{

    background:
        linear-gradient(
            135deg,
            var(--blue),
            var(--blue-dark)
        );

    color:white;

}


/* ==========================================
   CONTAINER
========================================== */

.container{

    flex:1;

    display:flex;

    justify-content:center;

    align-items:center;

    padding:20px;

}


/* ==========================================
   LOGIN BOX
========================================== */

.login-box{

    width:100%;

    max-width:380px;

    background:white;

    padding:30px;

    border-radius:20px;

    box-shadow:
        0 15px 40px
        rgba(0,0,0,.1);

    text-align:center;

}


/* ==========================================
   LOGO
========================================== */

.logo{

    margin-bottom:15px;

}

.logo img{

    width:90px;

    height:90px;

    object-fit:contain;

}


/* ==========================================
   TITLE
========================================== */

h2{

    margin-bottom:20px;

    color:var(--dark);

}


/* ==========================================
   ERRO
========================================== */

.erro{

    background:#fee2e2;

    color:#b91c1c;

    border:1px solid #fecaca;

    padding:10px;

    border-radius:10px;

    margin-bottom:15px;

    font-size:13px;

}


/* ==========================================
   INPUTS
========================================== */

input{

    width:100%;

    padding:12px;

    margin-bottom:12px;

    border-radius:12px;

    border:1px solid #ddd;

    outline:none;

    font-size:14px;

}

input:focus{

    border-color:var(--blue);

    box-shadow:
        0 0 0 3px
        rgba(11,77,219,.1);

}


/* ==========================================
   BUTTONS
========================================== */

button{

    width:100%;

    padding:12px;

    border:none;

    border-radius:12px;

    font-weight:700;

    cursor:pointer;

    transition:.3s;

}

.login-btn{

    background:
        linear-gradient(
            135deg,
            var(--blue),
            var(--blue-dark)
        );

    color:white;

}

.login-btn:hover{

    transform:translateY(-2px);

}


/* ==========================================
   CADASTRO
========================================== */

.cadastro-btn{

    margin-top:10px;

    background:
        linear-gradient(
            135deg,
            #10b981,
            #059669
        );

    color:white;

}

.cadastro-btn:hover{

    transform:translateY(-2px);

    filter:brightness(1.1);

}


/* ==========================================
   ÁREA
========================================== */

.area-btn{

    margin-top:10px;

    background:#111827;

    color:white;

}

.area-btn:hover{

    opacity:.9;

}


/* ==========================================
   TEXTO
========================================== */

.small{

    font-size:12px;

    color:var(--gray);

    margin-top:10px;

}

</style>

</head>


<body>


<!-- ==========================================
     TOPBAR
========================================== -->

<div class="topbar">

    <div class="nav-buttons">

        <a
            href="javascript:history.back()"
            class="nav-btn back"
        >
            ⬅ Voltar
        </a>

    </div>


    <div class="nav-buttons">

        <a
            href="index.php"
            class="nav-btn home"
        >
            🏠 Home
        </a>

    </div>

</div>


<!-- ==========================================
     LOGIN
========================================== -->

<div class="container">

    <div class="login-box">


        <!-- LOGO -->

        <div class="logo">

            <img
                src="img/logotipo.png"
                alt="Logo Interway"
            >

        </div>


        <h2>
            Entrar na sua conta
        </h2>


        <!-- ERRO -->

        <?php if (!empty($erro)): ?>

            <div class="erro">

                <?= htmlspecialchars(
                    $erro,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>

            </div>

        <?php endif; ?>


        <!-- FORMULÁRIO -->

        <form
            method="POST"
            action="login.php"
        >


            <input
                type="email"
                name="email"
                placeholder="E-mail"
                required
                value="<?= htmlspecialchars(
                    $_POST["email"] ?? "",
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>"
            >


            <input
                type="password"
                name="senha"
                placeholder="Senha"
                required
            >


            <button
                type="submit"
                class="login-btn"
            >
                Entrar
            </button>

        </form>


        <!-- CADASTRO -->

        <button
            class="cadastro-btn"
            onclick="cadastro()"
        >
            Cadastre-se
        </button>


        <!-- ÁREA ESPECÍFICA -->

        <button
            class="area-btn"
            onclick="area()"
        >
            Acessar área específica
        </button>


        <div class="small">

            Ainda não tem conta?
            Crie uma agora e participe da comunidade.

        </div>


    </div>

</div>


<script>


// ==========================================
// CADASTRO
// ==========================================

function cadastro(){

    window.location.href =
        "cadastro.php";

}


// ==========================================
// ÁREA ESPECÍFICA
// ==========================================

function area(){

    const choice = prompt(
        "Digite a área desejada:\n" +
        "1 - Comunidade\n" +
        "2 - Chat\n" +
        "3 - Bolsas\n" +
        "4 - Destinos"
    );


    switch(choice){

        case "1":

            window.location.href =
                "comunidade.php";

            break;


        case "2":

            window.location.href =
                "chat.php";

            break;


        case "3":

            window.location.href =
                "bolsas.php";

            break;


        case "4":

            window.location.href =
                "destinos.php";

            break;


        default:

            alert(
                "Área inválida!"
            );

    }

}

</