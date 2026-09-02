<?php

// =====================================================
// CONEXÃO COM O BANCO
// =====================================================

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "banco_interway";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");


// =====================================================
// BUSCAR BOLSAS
// =====================================================

$sql = "SELECT
            id_bolsa,
            nome,
            descricao,
            percentual_desconto,
            data_inicio,
            data_fim
        FROM bolsa_estudo
        ORDER BY id_bolsa DESC";

$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Bolsas de Estudo Internacionais</title>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet"
>

<style>

:root{
    --bg:#0b0f1a;
    --card:#121a2a;
    --card2:#0f1726;
    --blue:#3b82f6;
    --red:#ef4444;
    --text:#e5e7eb;
    --muted:#94a3b8;
    --border:rgba(255,255,255,0.08);
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:radial-gradient(
        circle at top,
        #111a2e,
        var(--bg)
    );

    color:var(--text);
}


/* ==========================================
   TOPBAR
========================================== */

.topbar{

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:12px 20px;

    background:rgba(15,23,42,0.9);

    backdrop-filter:blur(10px);

    border-bottom:1px solid rgba(255,255,255,0.08);

    position:sticky;

    top:0;

    z-index:1000;

}


/* ==========================================
   LOGO
========================================== */

.logo{

    display:flex;

    align-items:center;

    gap:10px;

}

.logo img{

    width:45px;

    height:45px;

    object-fit:contain;

}

.logo span{

    font-weight:700;

    color:var(--text);

}


/* ==========================================
   BOTÕES
========================================== */

.nav-buttons{

    display:flex;

    gap:10px;

}

.nav-btn{

    text-decoration:none;

    padding:10px 16px;

    border-radius:12px;

    font-weight:600;

    font-size:14px;

    transition:.3s;

}

.back{

    background:#e5e7eb;

    color:#111;

}

.home{

    background:#121a2a;

    color:white;

}

.nav-btn:hover{

    transform:translateY(-2px);

}


/* ==========================================
   HERO
========================================== */

.hero{

    text-align:center;

    padding:80px 20px 40px;

    position:relative;

}

.hero h1{

    font-size:3.2rem;

    color:#3b82f6;

    margin-bottom:15px;

}

.hero p{

    max-width:750px;

    margin:auto;

    color:var(--muted);

}


/* ==========================================
   SEARCH
========================================== */

.search{

    max-width:900px;

    margin:-20px auto 50px;

    padding:18px;

    background:rgba(255,255,255,0.03);

    backdrop-filter:blur(10px);

    border:1px solid var(--border);

    border-radius:16px;

}

.search input{

    width:100%;

    padding:14px;

    border:none;

    outline:none;

    background:transparent;

    color:var(--text);

    font-size:15px;

}

.search input::placeholder{

    color:#64748b;

}


/* ==========================================
   CONTAINER
========================================== */

.container{

    max-width:1200px;

    margin:auto;

    padding:20px;

}

.grid{

    display:grid;

    grid-template-columns:
        repeat(
            auto-fit,
            minmax(300px,1fr)
        );

    gap:25px;

}


/* ==========================================
   CARD
========================================== */

.card{

    background:
        linear-gradient(
            145deg,
            var(--card),
            var(--card2)
        );

    border:1px solid var(--border);

    border-radius:20px;

    overflow:hidden;

    transition:.4s;

    position:relative;

}

.card:hover{

    transform:
        translateY(-10px)
        scale(1.02);

    border-color:
        rgba(59,130,246,0.4);

}

.card img{

    width:100%;

    height:200px;

    object-fit:cover;

}

.content{

    padding:22px;

}

.tag{

    display:inline-block;

    padding:6px 12px;

    border-radius:999px;

    font-size:12px;

    font-weight:600;

    background:
        rgba(59,130,246,0.15);

    color:var(--blue);

    border:
        1px solid
        rgba(59,130,246,0.3);

    margin-bottom:12px;

}

h3{

    margin-bottom:8px;

}

.info{

    color:var(--muted);

    font-size:14px;

    margin-bottom:10px;

}

.descricao{

    color:var(--muted);

    font-size:14px;

    margin-bottom:15px;

}

.valor{

    color:#60a5fa;

    font-weight:600;

    margin-bottom:8px;

}

.periodo{

    color:#94a3b8;

    font-size:13px;

    margin-bottom:18px;

}


/* ==========================================
   BOTÃO
========================================== */

.btn{

    display:block;

    text-align:center;

    padding:12px;

    border-radius:12px;

    text-decoration:none;

    font-weight:600;

    color:white;

    background:#1e2d42;

    transition:.3s;

}

.btn:hover{

    filter:brightness(1.2);

}


/* ==========================================
   SEM RESULTADOS
========================================== */

.sem-resultados{

    grid-column:1 / -1;

    text-align:center;

    padding:50px;

    color:var(--muted);

}


/* ==========================================
   RESPONSIVO
========================================== */

@media(max-width:768px){

    .hero h1{

        font-size:2.2rem;

    }

    .nav-buttons{

        gap:5px;

    }

    .nav-btn{

        padding:8px 10px;

        font-size:12px;

    }

}

</style>

</head>


<body>


<!-- ==========================================
     TOPBAR
========================================== -->

<div class="topbar">

    <div class="logo">

        <img
            src="img/logotipo.png"
            alt="Logo Interway"
        >

        <span>INTERWAY</span>

    </div>


    <div class="nav-buttons">

        <a
            href="javascript:history.back()"
            class="nav-btn back"
        >
            Voltar
        </a>


        <a
            href="index.html"
            class="nav-btn home"
        >
            Home
        </a>

    </div>

</div>


<!-- ==========================================
     HERO
========================================== -->

<section class="hero">

    <h1>
        🎓 Bolsas Internacionais
    </h1>

    <p>
        Descubra oportunidades reais em universidades
        de elite ao redor do mundo.
    </p>

</section>


<!-- ==========================================
     PESQUISA
========================================== -->

<div class="search">

    <input
        type="text"
        id="search"
        placeholder="Pesquisar universidade ou país..."
    >

</div>


<!-- ==========================================
     BOLSAS
========================================== -->

<div class="container">

    <div class="grid" id="grid">

        <?php

        if ($resultado && $resultado->num_rows > 0):

            while ($bolsa = $resultado->fetch_assoc()):

                $nome =
                    htmlspecialchars(
                        $bolsa['nome'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                $descricao =
                    htmlspecialchars(
                        $bolsa['descricao'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                $universidade =
                    htmlspecialchars(
                        $bolsa['universidade'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                $pais =
                    htmlspecialchars(
                        $bolsa['pais'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                $nivel =
                    htmlspecialchars(
                        $bolsa['nivel'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                $area =
                    htmlspecialchars(
                        $bolsa['area'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                $imagem =
                    htmlspecialchars(
                        $bolsa['imagem'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                $site =
                    htmlspecialchars(
                        $bolsa['site_oficial'] ?? '#',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                $valor = $bolsa['valor'] ?? 0;

                $dataInicio =
                    !empty($bolsa['data_inicio'])
                    ? date(
                        'd/m/Y',
                        strtotime($bolsa['data_inicio'])
                    )
                    : '';

                $dataFim =
                    !empty($bolsa['data_fim'])
                    ? date(
                        'd/m/Y',
                        strtotime($bolsa['data_fim'])
                    )
                    : '';

        ?>

        <div
            class="card"
            data-name="<?=
                strtolower(
                    $universidade . ' ' .
                    $pais . ' ' .
                    $nome . ' ' .
                    $nivel . ' ' .
                    $area
                )
            ?>"
        >

            <?php if (!empty($imagem)): ?>

                <img
                    src="<?= $imagem ?>"
                    alt="<?= $universidade ?>"
                    onerror="this.style.display='none'"
                >

            <?php endif; ?>


            <div class="content">

                <span class="tag">
                    🌎 <?= $pais ?>
                </span>


                <h3>
                    <?= $universidade ?>
                </h3>


                <p class="descricao">
                    <?= $descricao ?>
                </p>


                <?php if (!empty($nome)): ?>

                    <p class="info">
                        🎓 <strong>Bolsa:</strong>
                        <?= $nome ?>
                    </p>

                <?php endif; ?>


                <?php if (!empty($nivel)): ?>

                    <p class="info">
                        📚 <strong>Nível:</strong>
                        <?= $nivel ?>
                    </p>

                <?php endif; ?>


                <?php if (!empty($area)): ?>

                    <p class="info">
                        📖 <strong>Área:</strong>
                        <?= $area ?>
                    </p>

                <?php endif; ?>


                <?php if ($valor > 0): ?>

                    <p class="valor">

                        💰 Bolsa:
                        R$ <?= number_format(
                            $valor,
                            2,
                            ',',
                            '.'
                        ) ?>

                    </p>

                <?php endif; ?>


                <?php if ($dataInicio && $dataFim): ?>

                    <p class="periodo">

                        📅
                        <?= $dataInicio ?>
                        até
                        <?= $dataFim ?>

                    </p>

                <?php endif; ?>


                <a
                    class="btn"
                    href="<?= $site ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Acessar Site Oficial
                </a>

            </div>

        </div>


        <?php

            endwhile;

        else:

        ?>

            <div class="sem-resultados">

                🎓

                <h3>
                    Nenhuma bolsa encontrada
                </h3>

                <p>
                    No momento não existem bolsas
                    cadastradas no sistema.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>


<!-- ==========================================
     PESQUISA COM JAVASCRIPT
========================================== -->

<script>

const input = document.getElementById("search");

const cards = document.querySelectorAll(".card");


input.addEventListener("input", function(){

    const valor =
        this.value
        .toLowerCase()
        .trim();


    cards.forEach(function(card){

        const nome =
            card.dataset.name;


        if(nome.includes(valor)){

            card.style.display = "block";

        }else{

            card.style.display = "none";

        }

    });

});

</script>


</body>

</html>

<?php

$conn->close();

?>