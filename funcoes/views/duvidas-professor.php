<!doctype html>
<html lang="pt-br">

<head>
    <?php
    // HEAD
    include 'includes/head.php';
    ?>
    <title><?php echo "Dúvidas - " . TITULO ?></title>
</head>

<?php

session_start();

if (!isset($_GET["status"])) {
    $_GET["status"] = "";
}

$checa_filtros = $_GET["status"] != "" ? " AND dv.ST_DUVIDA = '" . $_GET["status"] . "'" : "";

if (isset($_SESSION['usuario_id']) && isset($_SESSION['usuario_login']) && ($_SESSION['tipo_usuario'] == "P")) {
    $usuario_id = $_SESSION['usuario_id'];
    $usuario_login = $_SESSION['usuario_login'];
    $tipo_usuario = $_SESSION['tipo_usuario'];
    $professor_id = $_SESSION['professor_id'];
    $professor_nm = $_SESSION['professor_nm'];

    $vsSqlDisciplinaCurso = "
        SELECT
            d.DS_DISCIPLINA,
            d.NR_PERIODO,
            c.DS_CURSO
        FROM
            disciplina d
        LEFT JOIN
            curso c ON d.CD_CURSO = c.CD_CURSO
        WHERE
            d.CD_DISCIPLINA = '" . $_GET['disciplina'] . "' AND
            c.CD_CURSO = " . $_GET['curso'];
    $vrsExecutaDisciplinaCurso = mysqli_query($conexaoMysqli, $vsSqlDisciplinaCurso) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));

    $itens_por_pagina = 10;
    $numero_pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : "1";
    $pagina = ($numero_pagina - 1) * $itens_por_pagina;

    // retorna a quantidade total de objetos no banco de dados
    $vsSqlTotal = "
        SELECT
            dv.CD_DUVIDA,
            dv.DS_TITULO,
            dv.CD_DESTAQUE,
            dv.NR_CURTIDAS,
            dv.TP_RESPOSTA,
            dv.ST_DUVIDA,
            a.NM_ALUNO,
            DATE_FORMAT(dv.DT_HR, '%d/%m/%Y às %H:%i') AS DATA_HORA_DUVIDA,
            CASE dv.ST_DUVIDA
                WHEN 'P' THEN 'pendente'
                WHEN 'R' THEN 'respondida'
                WHEN 'OC' THEN 'oculta'
                ELSE ''
            END AS ST_DUVIDA_CLASS
        FROM
            duvida dv
        JOIN
            disciplina d ON dv.CD_DISCIPLINA = d.CD_DISCIPLINA
        JOIN
            professor_disciplina pdp ON pdp.CD_DISCIPLINA = d.CD_DISCIPLINA
        JOIN
            professor p ON pdp.CD_USUARIO = p.CD_USUARIO
        JOIN
            aluno a ON dv.CD_ALUNO = a.CD_ALUNO
        WHERE
            d.CD_DISCIPLINA = '" . $_GET['disciplina'] . "'
            $checa_filtros
        ORDER BY
            NR_CURTIDAS DESC, DT_HR DESC
    ";
    $vrsExecutaTotal = mysqli_query($conexaoMysqli, $vsSqlTotal) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));
    $viNumRowsTotal = mysqli_num_rows($vrsExecutaTotal);
    $voResultadoTotal = mysqli_fetch_object($vrsExecutaTotal);

    $vsSqlDuvidasDestacadas = "
        SELECT
            dv.CD_DUVIDA,
            dv.DS_TITULO,
            dv.CD_DESTAQUE,
            dv.NR_CURTIDAS,
            dv.TP_RESPOSTA,
            dv.ST_DUVIDA,
            a.NM_ALUNO,
            DATE_FORMAT(dv.DT_HR, '%d/%m/%Y às %H:%i') AS DATA_HORA_DUVIDA,
            CASE dv.ST_DUVIDA
                WHEN 'P' THEN 'pendente'
                WHEN 'R' THEN 'respondida'
                WHEN 'OC' THEN 'oculta'
                ELSE ''
            END AS ST_DUVIDA_CLASS
        FROM
            duvida dv
        JOIN
            disciplina d ON dv.CD_DISCIPLINA = d.CD_DISCIPLINA
        JOIN
            professor_disciplina pdp ON pdp.CD_DISCIPLINA = d.CD_DISCIPLINA
        JOIN
            professor p ON pdp.CD_USUARIO = p.CD_USUARIO
        JOIN
            aluno a ON dv.CD_ALUNO = a.CD_ALUNO
        WHERE
            dv.CD_DESTAQUE = 'S' AND
            dv.ST_DUVIDA = 'R' AND
            d.CD_DISCIPLINA = '" . $_GET['disciplina'] . "'
        ORDER BY
            NR_CURTIDAS DESC, DT_HR DESC
    ";
    $vrsExecutaDuvidasDestacadas = mysqli_query($conexaoMysqli, $vsSqlDuvidasDestacadas) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));
    $viNumRowsDuvidasDestacadas = mysqli_num_rows($vrsExecutaDuvidasDestacadas);

    // puxar produtos do banco
    $vsSqlDuvidas = "
        $vsSqlTotal
        LIMIT $pagina, $itens_por_pagina
    ";
    $vrsExecutaDuvidas = mysqli_query($conexaoMysqli, $vsSqlDuvidas) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));
    $viNumRowsDuvidas = mysqli_num_rows($vrsExecutaDuvidas);

    // definir numero de páginas
    $num_paginas = ceil($viNumRowsTotal / $itens_por_pagina);

    $limite_paginas = 10;
    $filtro_status = $_GET["status"] != "" ? "&status=" . $_GET["status"] : "";
    $filtro_curso = $_GET["curso"] != "" ? "&curso=" . $_GET["curso"] : "";
    $filtro_periodo = $_GET["periodo"] != "" ? "&periodo=" . $_GET["periodo"] : "";
    $filtro_disciplina = $_GET["disciplina"] != "" ? "&disciplina=" . $_GET["disciplina"] : "";

    $url_pagina = "duvidas-professor?" . $filtro_status . $filtro_curso . $filtro_periodo . $filtro_disciplina;
} else {
    echo "Usuário não está logado!";
    header("Location: login");
}

?>

<body>

    <?php
    // PRELOADER
    include 'includes/preloader.php';
    ?>

    <div class="page_wrapper">

        <header class="site_header site_header_1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-3 col-md-5">
                        <div class="site_logo">
                            <img src="<?php echo URL . "assets/images/logo-header.webp" ?>" title="<?php echo TITULO ?>" alt="<?php echo "Logo " . TITULO ?>">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-2">
                        <div class="title_page">
                            <?php
                            while ($voResultadoDisciplinaCurso = mysqli_fetch_object($vrsExecutaDisciplinaCurso)) {
                            ?>
                                <h2><?php echo $voResultadoDisciplinaCurso->DS_CURSO ?></h2>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 col-md-5">
                        <ul class="header_btns_group unordered_list_end">
                            <li>
                                <button class="mobile_menu_btn" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="far fa-bars"></i>
                                </button>
                            </li>
                            <li class="nome_aluno"><?php echo "Olá, Professor(a) " .  $_SESSION['professor_nm'] ?></li>
                            <li class="nome_aluno"> | </li>
                            <div class="dropdown">
                                <li>
                                    <button class="btn btn-dropdown-menu dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="<?php echo URL . "periodos-professor" ?>">Períodos</a></li>
                                        <li><a class="dropdown-item" href="<?php echo URL . "disciplinas-professor?curso=" . $_GET['curso'] . "&periodo=" . $_GET['periodo'] ?>">Disciplinas</a></li>
                                        <li><button type="button" class="abre_modal_logoff dropdown-item logoff-button"><i class="far fa-sign-out-alt" title="Sair"></i> Sair</button></li>
                                    </ul>
                                </li>
                            </div>
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
                                <li><button onclick="abre_modal_alunos(<?php echo '\'' . $_GET['disciplina'] . '\'' ?>)" type="button" data-bs-toggle="modal" data-bs-target=".exampleModal"><i class="far fa-users"></i> Visualizar integrantes da disciplina</button></li>
                            </ul>
                            <?php
                            mysqli_data_seek($vrsExecutaDisciplinaCurso, 0);
                            while ($voResultadoDisciplinaCurso = mysqli_fetch_object($vrsExecutaDisciplinaCurso)) {
                            ?>
                                <h1 class="page_title"><?php echo $voResultadoDisciplinaCurso->DS_DISCIPLINA . " " . $voResultadoDisciplinaCurso->NR_PERIODO . "º Período" ?></h1>
                            <?php } ?>
                            <div class="filtros">
                                <ul class="tags_list style_2 unordered_list <?php echo $viNumRowsDuvidasDestacadas == 0 ? "justify-content-center" : ""; ?>">
                                    <li class="todas"><label for="filtro_todos"><span class="checkbox_item"><input <?php echo $_GET["status"] == "" ? "checked" : ""; ?> value="" id="filtro_todos" type="checkbox"> Todas</span></label></li>
                                    <li class="pendentes"><label for="filtro_pendentes"><span class="checkbox_item"><input <?php echo $_GET["status"] == "P" ? "checked" : ""; ?> value="P" id="filtro_pendentes" type="checkbox"> Dúvidas pendentes</span></label></li>
                                    <li class="respondidas"><label for="filtro_respondidas"><span class="checkbox_item"><input <?php echo $_GET["status"] == "R" ? "checked" : ""; ?> value="R" id="filtro_respondidas" type="checkbox"> Dúvidas Respondidas</span></label></li>
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
                        <div class="<?php echo $viNumRowsDuvidasDestacadas == 0 ? "col-12" : "col-lg-7"; ?>">
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
                                if ($viNumRowsTotal > 0) {
                                ?>
                                    <ul class="comments_list unordered_list_block">
                                        <?php
                                        // LISTAGEM DE DÚVIDAS
                                        while ($voResultadoDuvidas = mysqli_fetch_object($vrsExecutaDuvidas)) {
                                        ?>
                                            <li>
                                                <?php
                                                // PERGUNTA
                                                $vsSqlPergunta = "
                                                    SELECT
                                                        CD_PERGUNTA,
                                                        DS_PERGUNTA,
                                                        IMAGEM
                                                    FROM
                                                        pergunta
                                                    WHERE
                                                        CD_DUVIDA = $voResultadoDuvidas->CD_DUVIDA
                                                    ORDER BY
                                                        CD_PERGUNTA
                                                    LIMIT 1
                                                ";
                                                $vrsExecutaPergunta = mysqli_query($conexaoMysqli, $vsSqlPergunta) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));
                                                while ($voResultadoPergunta = mysqli_fetch_object($vrsExecutaPergunta)) {
                                                ?>
                                                    <div class="<?php echo "comment_item collapsed " . $voResultadoDuvidas->ST_DUVIDA_CLASS ?>">
                                                        <div class="comment_author">
                                                            <div class="author_content">
                                                                <h4 class="author_name"><i class="far fa-user"></i> <?php echo $voResultadoDuvidas->NM_ALUNO ?></h4>
                                                                <h4 class="comment_date"><i class="far fa-calendar-alt"></i> <?php echo $voResultadoDuvidas->DATA_HORA_DUVIDA ?></h4>
                                                            </div>
                                                        </div>
                                                        <h3><?php echo $voResultadoDuvidas->DS_TITULO ?></h3>
                                                        <p><?php echo $voResultadoPergunta->DS_PERGUNTA ?></p>
                                                        <?php if ($voResultadoPergunta->IMAGEM !== NULL) { ?>
                                                            <img src="<?php echo URL . "funcoes/uploads/perguntas/" . $voResultadoPergunta->IMAGEM ?>" title="<?php echo $voResultadoDuvidas->DS_TITULO ?>" alt="<?php echo "Imagem " . $voResultadoDuvidas->DS_TITULO ?>">
                                                        <?php } ?>
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
                                                                IMAGEM,
                                                                DATE_FORMAT(DT_HR, '%d/%m/%Y às %H:%i') AS DATA_HORA_RESPOSTA
                                                            FROM
                                                                resposta
                                                            WHERE
                                                                CD_PERGUNTA = $voResultadoPergunta->CD_PERGUNTA
                                                            ORDER BY
                                                                CD_RESPOSTA
                                                            LIMIT 1
                                                        ";
                                                        $vrsExecutaResposta = mysqli_query($conexaoMysqli, $vsSqlResposta) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));
                                                        $viNumRowsResposta = mysqli_num_rows($vrsExecutaResposta);
                                                        if ($viNumRowsResposta == 0) {
                                                        ?>
                                                            <form id="form_create_resposta">
                                                                <input type="hidden" id="iDuvida" name="nDuvida" value="<?php echo $voResultadoDuvidas->CD_DUVIDA ?>">
                                                                <input type="hidden" id="iPergunta" name="nPergunta" value="<?php echo $voResultadoPergunta->CD_PERGUNTA ?>">
                                                                <h3 class="form_title">Envie sua resposta</h3>
                                                                <div class="form_item">
                                                                    <label for="iResposta" class="input_title text-uppercase"><i class="far fa-edit"></i> Resposta *</label>
                                                                    <textarea id="iResposta" name="nResposta" placeholder="Texto de resposta" required></textarea>
                                                                </div>
                                                                <div class="form_item">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label col-form-label-sm text-right input_title text-uppercase"><i class="far fa-image"></i> Imagem</label>
                                                                        <div class="col-sm-3">
                                                                            <input type="hidden" id="iImagemAtual" name="nImagemAtual" />
                                                                            <img id="imgImagemAtual" name="imgImagemAtual" src="" class="img-fluid" />
                                                                        </div>
                                                                        <div class="col-sm-7">
                                                                            <input type="file" class="dropify" id="iImagem" name="nImagem" data-height="100" accept=".jpg, .jpeg, .png" />
                                                                            <small class="fileHelp form-text text-muted"></small>
                                                                        </div>
                                                                    </div>
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
                                                                        <?php if ($voResultadoResposta->IMAGEM !== NULL) { ?>
                                                                            <img src="<?php echo URL . "funcoes/uploads/respostas/" . $voResultadoResposta->IMAGEM ?>" title="<?php echo $voResultadoDuvidas->DS_TITULO ?>" alt="<?php echo "Imagem " . $voResultadoDuvidas->DS_TITULO ?>">
                                                                        <?php } ?>
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
                                                            $vrsExecutaComentarios = mysqli_query($conexaoMysqli, $vsSqlComentarios) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));
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
                            <?php if ($num_paginas > 1) { ?>
                                <div class="pagination_wrap">
                                    <ul class="pagination_nav unordered_list justify-content-center">
                                        <li><a href="<?php echo URL . $url_pagina ?>"><i class="fas fa-long-arrow-left"></i></a></li>
                                        <?php
                                        if ($num_paginas <= $limite_paginas) {
                                            $minimo = 0;
                                            $maximo = $num_paginas;
                                        } else if ($numero_pagina < $limite_paginas) {
                                            $minimo = 0;
                                            $maximo = $limite_paginas;
                                        } else if ($numero_pagina > ($num_paginas - 10)) {
                                            $minimo = $num_paginas - $limite_paginas;
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
                            <?php } ?>
                        </div>
                        <?php
                        if ($viNumRowsDuvidasDestacadas >= 1) {
                        ?>
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
                                    // LISTAGEM DE DÚVIDAS DESTACADAS
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
                                                    CD_DUVIDA = $voResultadoDuvidasDestacadas->CD_DUVIDA
                                                ORDER BY
                                                    CD_PERGUNTA
                                                LIMIT 1
                                            ";
                                            $vrsExecutaPerguntaDestacada = mysqli_query($conexaoMysqli, $vsSqlPerguntaDestacada) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));
                                            while ($voResultadoPerguntaDestacada = mysqli_fetch_object($vrsExecutaPerguntaDestacada)) {
                                            ?>
                                                <div class="<?php echo "comment_item collapsed " . $voResultadoDuvidasDestacadas->ST_DUVIDA_CLASS ?>">
                                                    <div class="comment_author">
                                                        <div class="author_content">
                                                            <h4 class="author_name"><i class="far fa-user"></i> <?php echo $voResultadoDuvidasDestacadas->NM_ALUNO ?></h4>
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
                                                    $vrsExecutaRespostaDestacada = mysqli_query($conexaoMysqli, $vsSqlRespostaDestacada) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));
                                                    $viNumRowsRespostaDestacada = mysqli_num_rows($vrsExecutaRespostaDestacada);
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
                                                    $vrsExecutaComentariosDestacados = mysqli_query($conexaoMysqli, $vsSqlComentariosDestacados) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));
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
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        </main>

        <?php
        // FOOTER
        include 'includes/footer.php';

        // MODAL ALUNOS
        include 'includes/modal-alunos.php';
        ?>

    </div>

    <?php
    // CSS
    include 'includes/css.php';

    // SCRIPTS
    include 'includes/js.php';
    ?>

    <script src="<?php echo URL . "funcoes/scripts/duvida.js" ?>"></script>
    <script src="<?php echo URL . "funcoes/scripts/resposta.js" ?>"></script>
    <script src="<?php echo URL . "funcoes/js/modalAluno.js" ?>"></script>
    <script>
        function getParameterByName(name) {
            var url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }
    </script>

</body>

</html>