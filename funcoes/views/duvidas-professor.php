<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/images/favicon.webp">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/cursor.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vanilla-calendar.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <title>Dúvidas - TiraDúvida</title>
</head>

<?php

session_start();

$checa_filtros = $_GET["status"] != "" ? " AND dv.ST_DUVIDA = '" . $_GET["status"] . "'" : "";

if (isset($_SESSION['usuario_id']) && isset($_SESSION['usuario_login']) && isset($_SESSION['tipo_usuario'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $usuario_login = $_SESSION['usuario_login'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    require_once 'includes/conexao-mysqli.php';

    $professor_qry = "SELECT
            p.CD_PROFESSOR,
            p.NM_PROFESSOR
        FROM
            professor p
        WHERE
            p.CD_USUARIO = '$usuario_id'";
    $professor_exec = mysqli_query($mysqli, $professor_qry);

    if (mysqli_num_rows(result: $professor_exec) == 1) {
        while ($result = mysqli_fetch_object(result: $professor_exec)) {
            $_SESSION['professor_id'] = $result->CD_PROFESSOR;
            $_SESSION['professor_nm'] = $result->NM_PROFESSOR;
        }
    }

    $disciplina_qry = "SELECT
            d.DS_DISCIPLINA,
            c.DS_CURSO
        FROM
            disciplina d
        LEFT JOIN
            curso c ON d.CD_CURSO = c.CD_CURSO
        WHERE
            d.CD_DISCIPLINA = '" . $_GET['disciplina'] . "' AND
            c.CD_CURSO = " . $_GET['curso'];

    $disciplina_exec = mysqli_query(mysql: $mysqli, query: $disciplina_qry);

    // Verifica se a consulta foi bem-sucedida
    if (!$disciplina_exec) {
        // Exibe o erro SQL
        echo "Erro na consulta: " . mysqli_error(mysql: $mysqli);
    } else {
        // Verifica se a consulta retornou alguma linha
        if (mysqli_num_rows(result: $disciplina_exec) == 1) {
            while ($result = mysqli_fetch_object(result: $disciplina_exec)) {
                $disciplina = $result->DS_DISCIPLINA;
                $curso = $result->DS_CURSO;
            }
        } else {
            echo "Nenhum registro encontrado.";
        }
    }

    $itens_por_pagina = 12;

    $numero_pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : "1";

    // pegar a pagina atual
    $pagina = ($numero_pagina - 1) * $itens_por_pagina;

    // pega a quantidade total de objetos no banco de dados
    $vsSqlTotal = "
        SELECT
            dv.CD_DUVIDA,
            dv.DS_TITULO,
            dv.CD_DESTAQUE,
            dv.NR_CURTIDAS,
            dv.TP_RESPOSTA,
            DATE_FORMAT(dv.DT_HR, '%d/%m/%Y às %H:%i') AS DATA_HORA_DUVIDA,
            dv.ST_DUVIDA
        FROM
            duvida dv
        JOIN
            disciplina d ON dv.CD_DISCIPLINA = d.CD_DISCIPLINA
        JOIN
            professor_disciplina pdp ON pdp.CD_DISCIPLINA = d.CD_DISCIPLINA
        JOIN
            professor p ON pdp.CD_USUARIO = p.CD_USUARIO
        WHERE
            d.CD_DISCIPLINA = '" . $_GET['disciplina'] . "'
            $checa_filtros
        ";
    $vrsExecutaTotal = mysqli_query($mysqli, $vsSqlTotal) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($mysqli));
    $viNumRowsTotal = mysqli_num_rows($vrsExecutaTotal);
    $voResultadoTotal = mysqli_fetch_object($vrsExecutaTotal);

    // puxar produtos do banco
    $vsSqlDuvidas = "
        $vsSqlTotal
        LIMIT $pagina, $itens_por_pagina
    ";
    $vrsExecutaDuvidas = mysqli_query($mysqli, $vsSqlDuvidas) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($mysqli));
    $viNumRowsDuvidas = mysqli_num_rows($vrsExecutaDuvidas);

    // definir numero de páginas
    $num_paginas = ceil($viNumRowsTotal / $itens_por_pagina);

    $vsSqlPergunta = "
        SELECT
            CD_PERGUNTA,
            DS_PERGUNTA
        FROM
            pergunta
        WHERE
            CD_DUVIDA = $voResultadoTotal->CD_DUVIDA
        ORDER BY
            CD_PERGUNTA
        LIMIT 1
    ";
    $vrsExecutaPergunta = mysqli_query($mysqli, $vsSqlPergunta) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($mysqli));
} else {
    echo "Usuário não está logado!";
    header(header: "Location: login");
}

?>

<body>

    <div class="page_wrapper">

        <div class="backtotop">
            <a href="#" class="scroll">
                <i class="far fa-arrow-up"></i>
            </a>
        </div>

        <header class="site_header site_header_1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col col-lg-3 col-5">
                        <div class="site_logo">
                            <img src="assets/images/logo.png" alt="">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-2">
                        <div class="title_page">
                            <h2><?php echo $curso ?></h2>
                        </div>
                    </div>
                    <div class="col col-lg-3 col-5">
                        <ul class="header_btns_group unordered_list_end">
                            <li>
                                <button class="mobile_menu_btn" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="far fa-bars"></i>
                                </button>
                            </li>
                            <li class="nome_aluno"><?php echo "Olá, Professor(a) " .  $_SESSION['professor_nm'] ?></li>
                            <li class="nome_aluno"> | </li>
                            <li class="logout">
                                <a href="login">
                                    <i class="far fa-sign-out-alt" title="Sair"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <main class="page_content">
            <section class="page_banner">
                <div class="container">
                    <div class="content_wrapper">
                        <div class="row align-items-center">
                            <ul class="breadcrumb_nav unordered_list2">
                                <li><a href="<?php echo URL . "disciplinas-professor?curso=" . $_GET['curso'] . "&periodo=" . $_GET['periodo'] ?>"><i class="far fa-reply"></i> Voltar à página de disciplinas</a></li>
                                <li><button type="button" data-bs-toggle="modal" data-bs-target=".exampleModal"><i class="far fa-users"></i> Visualizar integrantes da disciplina</button></li>
                            </ul>
                            <h1 class="page_title"><?php echo $disciplina ?></h1>
                            <div class="filtros">
                                <ul class="tags_list style_2 unordered_list">
                                    <li class="todas"><label for="filtro_todos"><span class="checkbox_item"><input <?php echo $_GET["status"] == "" ? "checked" : ""; ?> value="" id="filtro_todos" type="checkbox"> Todas</span></label></li>
                                    <li class="pendentes"><label for="filtro_pendentes"><span class="checkbox_item"><input <?php echo $_GET["status"] == "P" ? "checked" : ""; ?> value="P" id="filtro_pendentes" type="checkbox"> Dúvidas pendentes</span></label></li>
                                    <li class="respondidas"><label for="filtro_respondidas"><span class="checkbox_item"><input <?php echo $_GET["status"] == "" ? "checked" : "R"; ?> value="R" id="filtro_respondidas" type="checkbox"> Dúvidas Respondidas</span></label></li>
                                    <li class="ocultas"><label for="filtro_ocultas"><span class="checkbox_item"><input <?php echo $_GET["status"] == "OC" ? "checked" : ""; ?> value="OC" id="filtro_ocultas" type="checkbox"> Dúvidas Ocultas</span></label></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="details_section blog_details_section section_space_md pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-7">
                            <div class="comments_list_wrap">
                                <h3 class="details_info_title">
                                    <i class="far fa-comments"></i>
                                    <?php
                                    echo " " . $viNumRowsTotal;
                                    echo $viNumRowsTotal == "1" ? " Dúvida" : " Dúvidas";
                                    ?>
                                </h3>
                                <?php
                                // VERÍFICA SE EXISTEM DÚVIDAS
                                if ($viNumRowsDuvidas > 0) {
                                ?>
                                    <ul class="comments_list unordered_list_block">
                                        <?php
                                        // LISTAGEM DE DÚVIDAS
                                        while ($voResultadoDuvidas = mysqli_fetch_object($vrsExecutaDuvidas)) {
                                        ?>
                                            <li>
                                                <?php
                                                // PERGUNTA
                                                while ($voResultadoPergunta = mysqli_fetch_object($vrsExecutaPergunta)) {
                                                ?>
                                                    <div class="comment_item respondida collapsed">
                                                        <div class="comment_author">
                                                            <div class="author_content">
                                                                <h4 class="author_name"><i class="far fa-user"></i> Aluno</h4>
                                                                <h4 class="comment_date"><i class="far fa-calendar-alt"></i> <?php echo $voResultadoDuvidas->DATA_HORA_DUVIDA ?></h4>
                                                            </div>
                                                        </div>
                                                        <h3><?php echo $voResultadoDuvidas->DS_TITULO ?></h3>
                                                        <p><?php echo $voResultadoPergunta->DS_PERGUNTA ?></p>
                                                        <div class="highlight_btn" data-duvida="<?php echo $voResultadoDuvidas->CD_DUVIDA ?>">
                                                            <?php echo $voResultadoDuvidas->CD_DESTAQUE  == "S" ? "<i class='fas fa-star'></i>" : "<i class='far fa-star'></i>" ?>
                                                        </div>
                                                        <div class="hide_btn" data-duvida="<?php echo $voResultadoDuvidas->CD_DUVIDA ?>"><i class="far fa-ban"></i></div>
                                                        <div class="reply_btn"><i class="far fa-thumbs-up"></i> <?php echo $voResultadoDuvidas->NR_CURTIDAS ?></div>
                                                        <div class="btn-collapse" role="button" data-bs-toggle="collapse" data-bs-target="<?php echo "#duvida-" . $voResultadoDuvidas->CD_DUVIDA ?>" aria-expanded="false" aria-controls="<?php echo "duvida-" . $voResultadoDuvidas->CD_DUVIDA ?>"></div>
                                                    </div>
                                                    <ul class="comments_list unordered_list_block collapse" id="<?php echo "duvida-" . $voResultadoDuvidas->CD_DUVIDA ?>">
                                                        <?php
                                                        // VERÍFICA SE EXISTE RESPOSTA DO PROFESSOR
                                                        $vsSqlResposta = "
                                                            SELECT
                                                                DS_RESPOSTA,
                                                                DATE_FORMAT(DT_HR, '%d/%m/%Y às %H:%i') AS DATA_HORA_RESPOSTA
                                                            FROM
                                                                resposta
                                                            WHERE
                                                                CD_PERGUNTA = $voResultadoPergunta->CD_PERGUNTA
                                                            ORDER BY
                                                                CD_RESPOSTA
                                                            LIMIT 1
                                                        ";
                                                        $vrsExecutaResposta = mysqli_query($mysqli, $vsSqlResposta) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($mysqli));
                                                        $viNumRowsResposta = mysqli_num_rows($vrsExecutaResposta);
                                                        if ($viNumRowsResposta == 0) {
                                                        ?>
                                                            <form id="form_create_resposta">
                                                                <input type="hidden" id="vsUrl" name="vsUrl" value="<?php echo URL ?>">
                                                                <input type="hidden" id="iPergunta" name="nPergunta" value="<?php echo $voResultadoPergunta->CD_PERGUNTA ?>">
                                                                <h3 class="form_title">Envie sua resposta</h3>
                                                                <div class="form_item">
                                                                    <label for="iResposta" class="input_title text-uppercase"><i class="far fa-edit"></i> Resposta</label>
                                                                    <textarea id="iResposta" name="nResposta" placeholder="Texto de resposta"></textarea>
                                                                </div>
                                                                <button id="botao_create_resposta" type="submit" class="btn btn_dark w-100"><span><small>Enviar</small> <small>Enviar</small></span></button>
                                                            </form>
                                                            <?php
                                                        } else {
                                                            // RESPOSTA
                                                            while ($voResultadoResposta = mysqli_fetch_object($vrsExecutaResposta)) {
                                                            ?>
                                                                <li>
                                                                    <div class="comment_item resposta">
                                                                        <div class="comment_author">
                                                                            <div class="author_content">
                                                                                <h4 class="author_name"><i class="far fa-chalkboard-teacher"></i> Resposta do professor</h4>
                                                                                <h4 class="comment_date"><i class="far fa-calendar-alt"></i> <?php echo $voResultadoResposta->DATA_HORA_RESPOSTA ?></h4>
                                                                            </div>
                                                                        </div>
                                                                        <p><?php echo $voResultadoResposta->DS_RESPOSTA ?></p>
                                                                        <div class="reply_btn">RESPOSTA</div>
                                                                    </div>
                                                                </li>
                                                            <?php
                                                            }
                                                            // COMENTÁRIO(S)        
                                                            $vsSqlComentarios = "
                                                                SELECT
                                                                    DS_PERGUNTA,
                                                                    DATE_FORMAT(DT_HR, '%d/%m/%Y às %H:%i') AS DATA_HORA_COMENTARIO
                                                                FROM
                                                                    pergunta
                                                                WHERE
                                                                    CD_DUVIDA =! $voResultadoDuvidas->CD_DUVIDA
                                                                ORDER BY
                                                                    CD_PERGUNTA
                                                            ";
                                                            $vrsExecutaComentarios = mysqli_query($mysqli, $vsSqlComentarios) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($mysqli));
                                                            while ($voResultadoComentarios = mysqli_fetch_object($vrsExecutaComentarios)) {
                                                            ?>
                                                                <li>
                                                                    <div class="comment_item comentario">
                                                                        <div class="comment_author">
                                                                            <div class="author_content">
                                                                                <h4 class="author_name"><i class="far fa-user"></i> Comentário do aluno</h4>
                                                                                <h4 class="comment_date"><i class="far fa-calendar-alt"></i> <?php echo $voResultadoComentarios->DATA_HORA_COMENTARIO ?></h4>
                                                                            </div>
                                                                        </div>
                                                                        <p><?php echo $voResultadoComentarios->DS_PERGUNTA ?></p>
                                                                        <div class="reply_btn">COMENTÁRIO</div>
                                                                    </div>
                                                                </li>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                <?php
                                                }
                                                ?>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="pagination_wrap">
                                <ul class="pagination_nav unordered_list justify-content-center">
                                    <?php
                                    $limite = 10;

                                    $filtro_status = $_GET["status"] != "" ? "&status=" . $_GET["status"] : "";
                                    $filtro_curso = $_GET["curso"] != "" ? "&curso=" . $_GET["curso"] : "";
                                    $filtro_periodo = $_GET["periodo"] != "" ? "&periodo=" . $_GET["periodo"] : "";
                                    $filtro_disciplina = $_GET["disciplina"] != "" ? "&disciplina=" . $_GET["disciplina"] : "";

                                    $url_pagina = "duvidas-professor?" . $filtro_status . $filtro_curso . $filtro_periodo . $filtro_disciplina;
                                    ?>
                                    <li><a href="<?php echo URL . $url_pagina ?>"><i class="fas fa-long-arrow-left"></i></a></li>
                                    <?php
                                    if ($num_paginas <= $limite) {
                                        $minimo = 0;
                                        $maximo = $num_paginas;
                                    } else if ($numero_pagina < $limite) {
                                        $minimo = 0;
                                        $maximo = $limite;
                                    } else if ($numero_pagina > ($num_paginas - 10)) {
                                        $minimo = $num_paginas - $limite;
                                        $maximo = $num_paginas;
                                    } else {
                                        $minimo = $numero_pagina - 6;
                                        $maximo = $numero_pagina + 5;
                                    }

                                    for ($i = $minimo; $i < $maximo; $i++) {
                                        $estilo = "";
                                        if ($numero_pagina == $i + 1)
                                            $estilo = "active";
                                    ?>
                                        <li class="<?php echo $estilo ?>">
                                            <a href="<?php echo URL . $url_pagina . "&pagina=";
                                                        echo $i + 1 ?>"><?php echo $i + 1 ?></a>
                                        </li>
                                    <?php } ?>
                                    <li><a href="<?php echo URL . $url_pagina . "&pagina=" . $num_paginas ?>"><i class="fas fa-long-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <section class="page_banner">
                                <div class="container">
                                    <div class="content_wrapper">
                                        <div class="row align-items-center">
                                            <h1 class="page_title">Dúvidas destacadas</h1>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <ul class="comments_list unordered_list_block">
                                <?php
                                // LISTAGEM DE DESTACADAS
                                $vsSqlDuvidasDestacadas = "
                                    SELECT
                                        dv.CD_DUVIDA,
                                        dv.DS_TITULO,
                                        dv.CD_DESTAQUE,
                                        dv.NR_CURTIDAS,
                                        dv.TP_RESPOSTA,
                                        DATE_FORMAT(dv.DT_HR, '%d/%m/%Y às %H:%i') AS DATA_HORA_DUVIDA,
                                        dv.ST_DUVIDA
                                    FROM
                                        duvida dv
                                    JOIN
                                        disciplina d ON dv.CD_DISCIPLINA = d.CD_DISCIPLINA
                                    JOIN
                                        professor_disciplina pdp ON pdp.CD_DISCIPLINA = d.CD_DISCIPLINA
                                    JOIN
                                        professor p ON pdp.CD_USUARIO = p.CD_USUARIO
                                    WHERE
                                        dv.CD_DESTAQUE = 'S' AND
                                        d.CD_DISCIPLINA = '" . $_GET['disciplina'] . "'";
                                $vrsExecutaDuvidasDestacadas = mysqli_query($mysqli, $vsSqlDuvidasDestacadas) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($mysqli));
                                while ($voResultadoDuvidasDestacadas = mysqli_fetch_object($vrsExecutaDuvidasDestacadas)) {
                                ?>
                                    <li>
                                        <?php
                                        // PERGUNTA DESTACADA
                                        $vsSqlPerguntaDestacada = "
                                            SELECT
                                                CD_PERGUNTA,
                                                DS_PERGUNTA
                                            FROM
                                                pergunta
                                            WHERE
                                                CD_DUVIDA = $voResultadoTotal->CD_DUVIDA
                                            ORDER BY
                                                CD_PERGUNTA
                                            LIMIT 1
                                        ";
                                        $vrsExecutaPerguntaDestacada = mysqli_query($mysqli, $vsSqlPerguntaDestacada) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($mysqli));
                                        while ($voResultadoPerguntaDestacada = mysqli_fetch_object($vrsExecutaPerguntaDestacada)) {
                                        ?>
                                            <div class="comment_item respondida collapsed">
                                                <div class="comment_author">
                                                    <div class="author_content">
                                                        <h4 class="author_name"><i class="far fa-user"></i> Aluno</h4>
                                                        <h4 class="comment_date"><i class="far fa-calendar-alt"></i> <?php echo $voResultadoDuvidasDestacadas->DATA_HORA_DUVIDA ?></h4>
                                                    </div>
                                                </div>
                                                <h3><?php echo $voResultadoDuvidasDestacadas->DS_TITULO ?></h3>
                                                <p><?php echo $voResultadoPerguntaDestacada->DS_PERGUNTA ?></p>
                                                <div class="highlight_btn" data-duvida="<?php echo $voResultadoDuvidasDestacadas->CD_DUVIDA ?>">
                                                    <?php echo $voResultadoDuvidasDestacadas->CD_DESTAQUE  == "S" ? "<i class='fas fa-star'></i>" : "<i class='far fa-star'></i>" ?>
                                                </div>
                                                <div class="hide_btn" data-duvida="<?php echo $voResultadoDuvidasDestacadas->CD_DUVIDA ?>"><i class="far fa-ban"></i></div>
                                                <div class="reply_btn"><i class="far fa-thumbs-up"></i> <?php echo $voResultadoDuvidasDestacadas->NR_CURTIDAS ?></div>
                                                <div class="btn-collapse" role="button" data-bs-toggle="collapse" data-bs-target="<?php echo "#duvidaDestaque-" . $voResultadoDuvidasDestacadas->CD_DUVIDA ?>" aria-expanded="false" aria-controls="<?php echo "duvida-" . $voResultadoDuvidasDestacadas->CD_DUVIDA ?>"></div>
                                            </div>
                                            <ul class="comments_list unordered_list_block collapse" id="<?php echo "duvidaDestaque-" . $voResultadoDuvidasDestacadas->CD_DUVIDA ?>">
                                                <?php
                                                // VERÍFICA SE EXISTE RESPOSTA DO PROFESSOR
                                                $vsSqlRespostaDestacada = "
                                                    SELECT
                                                        DS_RESPOSTA,
                                                        DATE_FORMAT(DT_HR, '%d/%m/%Y às %H:%i') AS DATA_HORA_RESPOSTA
                                                    FROM
                                                        resposta
                                                    WHERE
                                                        CD_PERGUNTA = $voResultadoPerguntaDestacada->CD_PERGUNTA
                                                    ORDER BY
                                                        CD_RESPOSTA
                                                    LIMIT 1
                                                ";
                                                $vrsExecutaRespostaDestacada = mysqli_query($mysqli, $vsSqlRespostaDestacada) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($mysqli));
                                                $viNumRowsRespostaDestacada = mysqli_num_rows($vrsExecutaRespostaDestacada);
                                                if ($viNumRowsRespostaDestacada == 0) {
                                                ?>
                                                    <form id="form_create_resposta">
                                                        <input type="hidden" id="vsUrl" name="vsUrl" value="<?php echo URL ?>">
                                                        <input type="hidden" id="iPergunta" name="nPergunta" value="<?php echo $voResultadoPerguntaDestacada->CD_PERGUNTA ?>">
                                                        <h3 class="form_title">Envie sua resposta</h3>
                                                        <div class="form_item">
                                                            <label for="iResposta" class="input_title text-uppercase"><i class="far fa-edit"></i> Resposta</label>
                                                            <textarea id="iResposta" name="nResposta" placeholder="Texto de resposta"></textarea>
                                                        </div>
                                                        <button id="botao_create_resposta" type="submit" class="btn btn_dark w-100"><span><small>Enviar</small> <small>Enviar</small></span></button>
                                                    </form>
                                                    <?php
                                                } else {
                                                    // RESPOSTA
                                                    while ($voResultadoRespostaDestacada = mysqli_fetch_object($vrsExecutaRespostaDestacada)) {
                                                    ?>
                                                        <li>
                                                            <div class="comment_item resposta">
                                                                <div class="comment_author">
                                                                    <div class="author_content">
                                                                        <h4 class="author_name"><i class="far fa-chalkboard-teacher"></i> Resposta do professor</h4>
                                                                        <h4 class="comment_date"><i class="far fa-calendar-alt"></i> <?php echo $voResultadoRespostaDestacada->DATA_HORA_RESPOSTA ?></h4>
                                                                    </div>
                                                                </div>
                                                                <p><?php echo $voResultadoRespostaDestacada->DS_RESPOSTA ?></p>
                                                                <div class="reply_btn">RESPOSTA</div>
                                                            </div>
                                                        </li>
                                                    <?php
                                                    }
                                                    // COMENTÁRIO(S)        
                                                    $vsSqlComentariosDestacados = "
                                                        SELECT
                                                            DS_PERGUNTA,
                                                            DATE_FORMAT(DT_HR, '%d/%m/%Y às %H:%i') AS DATA_HORA_COMENTARIO
                                                        FROM
                                                            pergunta
                                                        WHERE
                                                            CD_DUVIDA =! $voResultadoDuvidasDestacadas->CD_DUVIDA
                                                        ORDER BY
                                                            CD_PERGUNTA
                                                    ";
                                                    $vrsExecutaComentariosDestacados = mysqli_query($mysqli, $vsSqlComentariosDestacados) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($mysqli));
                                                    while ($voResultadoComentariosDestacados = mysqli_fetch_object($vrsExecutaComentariosDestacados)) {
                                                    ?>
                                                        <li>
                                                            <div class="comment_item comentario">
                                                                <div class="comment_author">
                                                                    <div class="author_content">
                                                                        <h4 class="author_name"><i class="far fa-user"></i> Comentário do aluno</h4>
                                                                        <h4 class="comment_date"><i class="far fa-calendar-alt"></i> <?php echo $voResultadoComentariosDestacados->DATA_HORA_COMENTARIO ?></h4>
                                                                    </div>
                                                                </div>
                                                                <p><?php echo $voResultadoComentariosDestacados->DS_PERGUNTA ?></p>
                                                                <div class="reply_btn">COMENTÁRIO</div>
                                                            </div>
                                                        </li>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="site_footer">
            <div class="footer_widget_area">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col col-lg-3 col-md-6 col-sm-6">
                            <div class="footer_widget">
                                <div class="site_logo">
                                    <img src="assets/images/logo.png" title="TiraDúvida" alt="TiraDúvida">
                                    <p>Fale com seu professor agora!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright_widget">
                <div class="container">
                    <p class="copyright_text text-center mb-0">Copyright 2024 © TiraDúvida. Todos direitos reservados | <a href="politica-privacidade">Política de privacidade</a>.</p>
                </div>
            </div>
        </footer>

    </div>

    <div id="iModalAlunos"></div>

    <link href="<?php echo URL . "assets/css/sweetalert.min.css" ?>" rel="stylesheet">
    <script src="<?php echo URL . "assets/js/sweetalert.min.js" ?>"></script>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-dropdown-ml-hack.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/tilt.min.js"></script>
    <script src="assets/js/parallax.min.js"></script>
    <script src="assets/js/parallax-scroll.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/magnific-popup.min.js"></script>
    <script src="assets/js/waypoint.js"></script>
    <script src="assets/js/counterup.min.js"></script>
    <script src="assets/js/countdown.js"></script>
    <script src="assets/js/vanilla-calendar.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="funcoes/scripts/duvida.js"></script>
    <script src="funcoes/scripts/resposta.js"></script>
    <script src="funcoes/js/modalAluno.js"></script>

    <script>
        // Função para capturar valores de parâmetros da URL
        function getParameterByName(name) {
            var url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        // Função para redirecionar a página com o status e preservar outros parâmetros
        $('input[type=checkbox]').on('change', function() {
            var status = $(this).val();

            // Obtém os valores de curso, período e disciplina
            var curso = getParameterByName('curso');
            var periodo = getParameterByName('periodo');
            var disciplina = getParameterByName('disciplina');

            // Monta a nova URL com os parâmetros existentes e o novo status
            var newUrl = "?status=" + status;

            if (curso) newUrl += "&curso=" + curso;
            if (periodo) newUrl += "&periodo=" + periodo;
            if (disciplina) newUrl += "&disciplina=" + disciplina;

            // Redireciona para a nova URL
            window.location.href = newUrl;
        });
    </script>

</body>

</html>