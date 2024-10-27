<!doctype html>
<html lang="en">

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

if (isset($_SESSION['usuario_id']) && isset($_SESSION['usuario_login']) && isset($_SESSION['tipo_usuario'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    require_once 'includes/conexao-mysqli.php';

    $aluno_qry = "SELECT
            a.CD_ALUNO,
            a.NM_ALUNO                       
        FROM
            aluno a
        WHERE
            a.CD_USUARIO = '$usuario_id'";
    $aluno_exec = mysqli_query($mysqli, $aluno_qry);

    if (mysqli_num_rows($aluno_exec) == 1) {
        while ($result = mysqli_fetch_object($aluno_exec)) {
            $_SESSION['aluno_id'] = $result->CD_ALUNO;
            $_SESSION['aluno_nm'] = $result->NM_ALUNO;
            $aluno_nm = $_SESSION['aluno_nm'];
        }
    }

    $aluno_duvidas_qry = "SELECT
            dv.CD_DUVIDA,
            dv.CD_DESTAQUE,
            dv.NR_CURTIDAS,
            dv.TP_RESPOSTA,
            dv.DT_HR,
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
            pd.CD_USUARIO = '$usuario_id' AND pd.ST_AL_DISCIPLINA = 'A' AND d.ST_DISCIPLINA = 'A'";

    $aluno_duvidas_exec = mysqli_query($mysqli, $aluno_duvidas_qry);

    if (mysqli_num_rows($aluno_duvidas_exec) >= 1) {

        $qtdDuvidas = 0;
        while ($dados_disc = mysqli_fetch_array($aluno_duvidas_exec)) {
            $cdCurso[$qtdDisciplina]        = $dados_disc['CD_CURSO'];
            $dsCurso[$qtdDisciplina]        = $dados_disc['DS_CURSO'];
            $cdTurno[$qtdDisciplina]        = $dados_disc['CD_TURNO'];
            $cdDisciplina[$qtdDisciplina]   = $dados_disc['CD_DISCIPLINA'];
            $nrPeriodo[$qtdDisciplina]      = $dados_disc['NR_PERIODO'];
            $dsDisciplina[$qtdDisciplina]   = $dados_disc['DS_DISCIPLINA'];
            $nmProfessor[$qtdDisciplina]    = $dados_disc['NM_PROFESSOR'];
            $dvTotal[$qtdDisciplina]        = $dados_disc['DV_TOTAL'];
            $dvPendente[$qtdDisciplina]     = $dados_disc['DV_PENDENTE'];
            $qtdDuvidas++;
        }
    } else {
        echo "Nenhuma disciplina ativa encontrada para este aluno.";
    }
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
                            <h2>Engenharia de Software</h2>
                        </div>
                    </div>
                    <div class="col col-lg-3 col-5">
                        <ul class="header_btns_group unordered_list_end">
                            <li>
                                <button class="mobile_menu_btn" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="far fa-bars"></i>
                                </button>
                            </li>
                            <li class="nome_aluno">Olá, John Doe</li>
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

            <section class="details_section blog_details_section section_space_md">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-7">
                            <section class="page_banner">
                                <div class="container">
                                    <div class="content_wrapper">
                                        <div class="row align-items-center">
                                            <ul class="breadcrumb_nav unordered_list2">
                                                <li><a href="disciplinas-aluno"><i class="far fa-reply"></i> Voltar à página de disciplinas</a></li>
                                            </ul>
                                            <h1 class="page_title">Internet das coisas</h1>
                                            <div class="filtros">
                                                <ul class="tags_list style_2 unordered_list">
                                                    <li class="todas"><label for="filtro_todos"><span class="checkbox_item"><input id="filtro_todos" type="checkbox" checked> Todas (10)</span></label></li>
                                                    <li class="pendentes"><label for="filtro_pendentes"><span class="checkbox_item"><input id="filtro_pendentes" type="checkbox"> Dúvidas pendentes (5)</span></label></li>
                                                    <li class="respondidas"><label for="filtro_respondidas"><span class="checkbox_item"><input id="filtro_respondidas" type="checkbox"> Dúvidas Respondidas (5)</span></label></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="event_section">
                                <div class="calltoaction_form mb-0">
                                    <form id="form_create_duvida">
                                        <h3 class="form_title">Envie sua dúvida</h3>
                                        <div class="form_item">
                                            <label for="iTituloDuvida" class="input_title text-uppercase"><i class="far fa-pencil"></i> Título</label>
                                            <input id="iTituloDuvida" name="nTituloDuvida" type="text" placeholder="Assunto da dúvida">
                                        </div>
                                        <div class="form_item">
                                            <label for="iPerguntaDuvida" class="input_title text-uppercase"><i class="far fa-edit"></i> Pergunta</label>
                                            <textarea id="iPerguntaDuvida" name="nPerguntaDuvida" placeholder="Detalhes da dúvida"></textarea>
                                        </div>
                                        <button id="botao_create_duvida" type="submit" class="btn btn_dark w-100"><span><small>Enviar</small> <small>Enviar</small></span></button>
                                    </form>
                                </div>
                            </div>
                            <div class="comments_list_wrap">
                                <h3 class="details_info_title"><i class="far fa-comments"></i> 10 Dúvidas</h3>
                                <ul class="comments_list unordered_list_block">
                                    <li>
                                        <div class="comment_item respondida collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#duvida_2" aria-expanded="false" aria-controls="duvida_2">
                                            <div class="comment_author">
                                                <div class="author_content">
                                                    <h4 class="author_name"><i class="far fa-user"></i> Aluno</h4>
                                                    <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 15:30</h4>
                                                </div>
                                            </div>
                                            <h3>Blandit libero volutpat sed cras ornare arcu?</h3>
                                            <p>
                                                Platea dictumst vestibulum rhoncus est pellentesque
                                                elit ullamcorper dignissim cras. Vitae ultricies leo
                                                integer malesuada nunc vel. Nibh cras pulvinar
                                                mattis nunc sed. Convallis a cras semper auctor
                                                neque vitae tempus. Mattis molestie a iaculis at
                                                erat pellentesque adipiscing.
                                            </p>
                                            <div class="reply_btn contador"><i class="far fa-thumbs-up"></i> <span class="like_count">15</span></div>
                                        </div>
                                        <ul class="comments_list unordered_list_block collapse" id="duvida_2">
                                            <li>
                                                <div class="comment_item resposta">
                                                    <div class="comment_author">
                                                        <div class="author_content">
                                                            <h4 class="author_name"><i class="far fa-chalkboard-teacher"></i> Resposta do professor</h4>
                                                            <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 16:00</h4>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        Platea dictumst vestibulum rhoncus est
                                                        pellentesque elit ullamcorper dignissim cras.
                                                        Vitae ultricies leo integer malesuada nunc vel.
                                                        Nibh cras pulvinar mattis nunc sed. Convallis a
                                                        cras semper auctor neque vitae tempus. Mattis
                                                        molestie a iaculis at erat pellentesque
                                                        adipiscing.
                                                    </p>
                                                    <div class="reply_btn">RESPOSTA</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="comment_item comentario">
                                                    <div class="comment_author">
                                                        <div class="author_content">
                                                            <h4 class="author_name"><i class="far fa-user"></i> Comentário do aluno</h4>
                                                            <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 16:15</h4>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        Platea dictumst vestibulum rhoncus est
                                                        pellentesque elit ullamcorper dignissim cras.
                                                        Vitae ultricies leo integer malesuada nunc vel.
                                                        Nibh cras pulvinar mattis nunc sed. Convallis a
                                                        cras semper auctor neque vitae tempus. Mattis
                                                        molestie a iaculis at erat pellentesque
                                                        adipiscing.
                                                    </p>
                                                    <div class="reply_btn">COMENTÁRIO</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="comment_item">
                                            <div class="comment_author">
                                                <div class="author_content">
                                                    <h4 class="author_name"><i class="far fa-user"></i> Aluno</h4>
                                                    <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 15:30</h4>
                                                </div>
                                            </div>
                                            <h3>Blandit libero volutpat sed cras ornare arcu?</h3>
                                            <p>
                                                Platea dictumst vestibulum rhoncus est pellentesque
                                                elit ullamcorper dignissim cras. Vitae ultricies leo
                                                integer malesuada nunc vel. Nibh cras pulvinar
                                                mattis nunc sed. Convallis a cras semper auctor
                                                neque vitae tempus. Mattis molestie a iaculis at
                                                erat pellentesque adipiscing.
                                            </p>
                                            <div class="reply_btn contador"><i class="far fa-thumbs-up"></i> <span class="like_count">15</span></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment_item respondida collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#duvida_2" aria-expanded="false" aria-controls="duvida_2">
                                            <div class="comment_author">
                                                <div class="author_content">
                                                    <h4 class="author_name"><i class="far fa-user"></i> Aluno</h4>
                                                    <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 15:30</h4>
                                                </div>
                                            </div>
                                            <h3>Blandit libero volutpat sed cras ornare arcu?</h3>
                                            <p>
                                                Platea dictumst vestibulum rhoncus est pellentesque
                                                elit ullamcorper dignissim cras. Vitae ultricies leo
                                                integer malesuada nunc vel. Nibh cras pulvinar
                                                mattis nunc sed. Convallis a cras semper auctor
                                                neque vitae tempus. Mattis molestie a iaculis at
                                                erat pellentesque adipiscing.
                                            </p>
                                            <div class="reply_btn contador"><i class="far fa-thumbs-up"></i> <span class="like_count">15</span></div>
                                        </div>
                                        <ul class="comments_list unordered_list_block collapse" id="duvida_2">
                                            <li>
                                                <div class="comment_item resposta">
                                                    <div class="comment_author">
                                                        <div class="author_content">
                                                            <h4 class="author_name"><i class="far fa-chalkboard-teacher"></i> Resposta do professor</h4>
                                                            <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 16:00</h4>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        Platea dictumst vestibulum rhoncus est
                                                        pellentesque elit ullamcorper dignissim cras.
                                                        Vitae ultricies leo integer malesuada nunc vel.
                                                        Nibh cras pulvinar mattis nunc sed. Convallis a
                                                        cras semper auctor neque vitae tempus. Mattis
                                                        molestie a iaculis at erat pellentesque
                                                        adipiscing.
                                                    </p>
                                                    <div class="reply_btn">RESPOSTA</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="comment_item comentario">
                                                    <div class="comment_author">
                                                        <div class="author_content">
                                                            <h4 class="author_name"><i class="far fa-user"></i> Comentário do aluno</h4>
                                                            <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 16:15</h4>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        Platea dictumst vestibulum rhoncus est
                                                        pellentesque elit ullamcorper dignissim cras.
                                                        Vitae ultricies leo integer malesuada nunc vel.
                                                        Nibh cras pulvinar mattis nunc sed. Convallis a
                                                        cras semper auctor neque vitae tempus. Mattis
                                                        molestie a iaculis at erat pellentesque
                                                        adipiscing.
                                                    </p>
                                                    <div class="reply_btn">COMENTÁRIO</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="comment_item">
                                            <div class="comment_author">
                                                <div class="author_content">
                                                    <h4 class="author_name"><i class="far fa-user"></i> Aluno</h4>
                                                    <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 15:30</h4>
                                                </div>
                                            </div>
                                            <h3>Blandit libero volutpat sed cras ornare arcu?</h3>
                                            <p>
                                                Platea dictumst vestibulum rhoncus est pellentesque
                                                elit ullamcorper dignissim cras. Vitae ultricies leo
                                                integer malesuada nunc vel. Nibh cras pulvinar
                                                mattis nunc sed. Convallis a cras semper auctor
                                                neque vitae tempus. Mattis molestie a iaculis at
                                                erat pellentesque adipiscing.
                                            </p>
                                            <div class="reply_btn contador"><i class="far fa-thumbs-up"></i> <span class="like_count">15</span></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment_item">
                                            <div class="comment_author">
                                                <div class="author_content">
                                                    <h4 class="author_name"><i class="far fa-user"></i> Aluno</h4>
                                                    <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 15:30</h4>
                                                </div>
                                            </div>
                                            <h3>Blandit libero volutpat sed cras ornare arcu?</h3>
                                            <p>
                                                Platea dictumst vestibulum rhoncus est pellentesque
                                                elit ullamcorper dignissim cras. Vitae ultricies leo
                                                integer malesuada nunc vel. Nibh cras pulvinar
                                                mattis nunc sed. Convallis a cras semper auctor
                                                neque vitae tempus. Mattis molestie a iaculis at
                                                erat pellentesque adipiscing.
                                            </p>
                                            <div class="reply_btn contador"><i class="far fa-thumbs-up"></i> <span class="like_count">15</span></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="pagination_wrap">
                                <ul class="pagination_nav unordered_list justify-content-center">
                                    <li><a href="#!"><i class="fas fa-long-arrow-left"></i></a></li>
                                    <li class="active"><a href="#!">1</a></li>
                                    <li><a href="#!">2</a></li>
                                    <li><a href="#!">3</a></li>
                                    <li><a href="#!">4</a></li>
                                    <li><a href="#!"><i class="fas fa-long-arrow-right"></i></a></li>
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
                                <li>
                                    <div class="comment_item respondida collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#duvida_1" aria-expanded="false" aria-controls="duvida_1">
                                        <div class="comment_author">
                                            <div class="author_content">
                                                <h4 class="author_name"><i class="far fa-user"></i> Aluno</h4>
                                                <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 15:30</h4>
                                            </div>
                                        </div>
                                        <h3>Blandit libero volutpat sed cras ornare arcu?</h3>
                                        <p>
                                            Platea dictumst vestibulum rhoncus est pellentesque
                                            elit ullamcorper dignissim cras. Vitae ultricies leo
                                            integer malesuada nunc vel. Nibh cras pulvinar
                                            mattis nunc sed. Convallis a cras semper auctor
                                            neque vitae tempus. Mattis molestie a iaculis at
                                            erat pellentesque adipiscing.
                                        </p>
                                        <span class="star"><i class="fas fa-star"></i></span>
                                        <div class="reply_btn contador"><i class="far fa-thumbs-up"></i> <span class="like_count">15</span></div>
                                    </div>
                                    <ul class="comments_list unordered_list_block collapse" id="duvida_1">
                                        <li>
                                            <div class="comment_item resposta">
                                                <div class="comment_author">
                                                    <div class="author_content">
                                                        <h4 class="author_name"><i class="far fa-chalkboard-teacher"></i> Resposta do professor</h4>
                                                        <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 16:00</h4>
                                                    </div>
                                                </div>
                                                <p>
                                                    Platea dictumst vestibulum rhoncus est
                                                    pellentesque elit ullamcorper dignissim cras.
                                                    Vitae ultricies leo integer malesuada nunc vel.
                                                    Nibh cras pulvinar mattis nunc sed. Convallis a
                                                    cras semper auctor neque vitae tempus. Mattis
                                                    molestie a iaculis at erat pellentesque
                                                    adipiscing.
                                                </p>
                                                <div class="reply_btn">RESPOSTA</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="comment_item comentario">
                                                <div class="comment_author">
                                                    <div class="author_content">
                                                        <h4 class="author_name"><i class="far fa-user"></i> Comentário do aluno</h4>
                                                        <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 16:15</h4>
                                                    </div>
                                                </div>
                                                <p>
                                                    Platea dictumst vestibulum rhoncus est
                                                    pellentesque elit ullamcorper dignissim cras.
                                                    Vitae ultricies leo integer malesuada nunc vel.
                                                    Nibh cras pulvinar mattis nunc sed. Convallis a
                                                    cras semper auctor neque vitae tempus. Mattis
                                                    molestie a iaculis at erat pellentesque
                                                    adipiscing.
                                                </p>
                                                <div class="reply_btn">COMENTÁRIO</div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="comment_item respondida collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#duvida_1" aria-expanded="false" aria-controls="duvida_1">
                                        <div class="comment_author">
                                            <div class="author_content">
                                                <h4 class="author_name"><i class="far fa-user"></i> Aluno</h4>
                                                <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 15:30</h4>
                                            </div>
                                        </div>
                                        <h3>Blandit libero volutpat sed cras ornare arcu?</h3>
                                        <p>
                                            Platea dictumst vestibulum rhoncus est pellentesque
                                            elit ullamcorper dignissim cras. Vitae ultricies leo
                                            integer malesuada nunc vel. Nibh cras pulvinar
                                            mattis nunc sed. Convallis a cras semper auctor
                                            neque vitae tempus. Mattis molestie a iaculis at
                                            erat pellentesque adipiscing.
                                        </p>
                                        <span class="star"><i class="fas fa-star"></i></span>
                                        <div class="reply_btn contador"><i class="far fa-thumbs-up"></i> <span class="like_count">15</span></div>
                                    </div>
                                    <ul class="comments_list unordered_list_block collapse" id="duvida_1">
                                        <li>
                                            <div class="comment_item resposta">
                                                <div class="comment_author">
                                                    <div class="author_content">
                                                        <h4 class="author_name"><i class="far fa-chalkboard-teacher"></i> Resposta do professor</h4>
                                                        <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 16:00</h4>
                                                    </div>
                                                </div>
                                                <p>
                                                    Platea dictumst vestibulum rhoncus est
                                                    pellentesque elit ullamcorper dignissim cras.
                                                    Vitae ultricies leo integer malesuada nunc vel.
                                                    Nibh cras pulvinar mattis nunc sed. Convallis a
                                                    cras semper auctor neque vitae tempus. Mattis
                                                    molestie a iaculis at erat pellentesque
                                                    adipiscing.
                                                </p>
                                                <div class="reply_btn">RESPOSTA</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="comment_item comentario">
                                                <div class="comment_author">
                                                    <div class="author_content">
                                                        <h4 class="author_name"><i class="far fa-user"></i> Comentário do aluno</h4>
                                                        <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 16:15</h4>
                                                    </div>
                                                </div>
                                                <p>
                                                    Platea dictumst vestibulum rhoncus est
                                                    pellentesque elit ullamcorper dignissim cras.
                                                    Vitae ultricies leo integer malesuada nunc vel.
                                                    Nibh cras pulvinar mattis nunc sed. Convallis a
                                                    cras semper auctor neque vitae tempus. Mattis
                                                    molestie a iaculis at erat pellentesque
                                                    adipiscing.
                                                </p>
                                                <div class="reply_btn">COMENTÁRIO</div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="comment_item respondida collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#duvida_1" aria-expanded="false" aria-controls="duvida_1">
                                        <div class="comment_author">
                                            <div class="author_content">
                                                <h4 class="author_name"><i class="far fa-user"></i> Aluno</h4>
                                                <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 15:30</h4>
                                            </div>
                                        </div>
                                        <h3>Blandit libero volutpat sed cras ornare arcu?</h3>
                                        <p>
                                            Platea dictumst vestibulum rhoncus est pellentesque
                                            elit ullamcorper dignissim cras. Vitae ultricies leo
                                            integer malesuada nunc vel. Nibh cras pulvinar
                                            mattis nunc sed. Convallis a cras semper auctor
                                            neque vitae tempus. Mattis molestie a iaculis at
                                            erat pellentesque adipiscing.
                                        </p>
                                        <span class="star"><i class="fas fa-star"></i></span>
                                        <div class="reply_btn contador"><i class="far fa-thumbs-up"></i> <span class="like_count">15</span></div>
                                    </div>
                                    <ul class="comments_list unordered_list_block collapse" id="duvida_1">
                                        <li>
                                            <div class="comment_item resposta">
                                                <div class="comment_author">
                                                    <div class="author_content">
                                                        <h4 class="author_name"><i class="far fa-chalkboard-teacher"></i> Resposta do professor</h4>
                                                        <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 16:00</h4>
                                                    </div>
                                                </div>
                                                <p>
                                                    Platea dictumst vestibulum rhoncus est
                                                    pellentesque elit ullamcorper dignissim cras.
                                                    Vitae ultricies leo integer malesuada nunc vel.
                                                    Nibh cras pulvinar mattis nunc sed. Convallis a
                                                    cras semper auctor neque vitae tempus. Mattis
                                                    molestie a iaculis at erat pellentesque
                                                    adipiscing.
                                                </p>
                                                <div class="reply_btn">RESPOSTA</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="comment_item comentario">
                                                <div class="comment_author">
                                                    <div class="author_content">
                                                        <h4 class="author_name"><i class="far fa-user"></i> Comentário do aluno</h4>
                                                        <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 16:15</h4>
                                                    </div>
                                                </div>
                                                <p>
                                                    Platea dictumst vestibulum rhoncus est
                                                    pellentesque elit ullamcorper dignissim cras.
                                                    Vitae ultricies leo integer malesuada nunc vel.
                                                    Nibh cras pulvinar mattis nunc sed. Convallis a
                                                    cras semper auctor neque vitae tempus. Mattis
                                                    molestie a iaculis at erat pellentesque
                                                    adipiscing.
                                                </p>
                                                <div class="reply_btn">COMENTÁRIO</div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="comment_item respondida collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#duvida_1" aria-expanded="false" aria-controls="duvida_1">
                                        <div class="comment_author">
                                            <div class="author_content">
                                                <h4 class="author_name"><i class="far fa-user"></i> Aluno</h4>
                                                <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 15:30</h4>
                                            </div>
                                        </div>
                                        <h3>Blandit libero volutpat sed cras ornare arcu?</h3>
                                        <p>
                                            Platea dictumst vestibulum rhoncus est pellentesque
                                            elit ullamcorper dignissim cras. Vitae ultricies leo
                                            integer malesuada nunc vel. Nibh cras pulvinar
                                            mattis nunc sed. Convallis a cras semper auctor
                                            neque vitae tempus. Mattis molestie a iaculis at
                                            erat pellentesque adipiscing.
                                        </p>
                                        <span class="star"><i class="fas fa-star"></i></span>
                                        <div class="reply_btn contador"><i class="far fa-thumbs-up"></i> <span class="like_count">15</span></div>
                                    </div>
                                    <ul class="comments_list unordered_list_block collapse" id="duvida_1">
                                        <li>
                                            <div class="comment_item resposta">
                                                <div class="comment_author">
                                                    <div class="author_content">
                                                        <h4 class="author_name"><i class="far fa-chalkboard-teacher"></i> Resposta do professor</h4>
                                                        <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 16:00</h4>
                                                    </div>
                                                </div>
                                                <p>
                                                    Platea dictumst vestibulum rhoncus est
                                                    pellentesque elit ullamcorper dignissim cras.
                                                    Vitae ultricies leo integer malesuada nunc vel.
                                                    Nibh cras pulvinar mattis nunc sed. Convallis a
                                                    cras semper auctor neque vitae tempus. Mattis
                                                    molestie a iaculis at erat pellentesque
                                                    adipiscing.
                                                </p>
                                                <div class="reply_btn">RESPOSTA</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="comment_item comentario">
                                                <div class="comment_author">
                                                    <div class="author_content">
                                                        <h4 class="author_name"><i class="far fa-user"></i> Comentário do aluno</h4>
                                                        <h4 class="comment_date"><i class="far fa-calendar-alt"></i> 20/03/2024 às 16:15</h4>
                                                    </div>
                                                </div>
                                                <p>
                                                    Platea dictumst vestibulum rhoncus est
                                                    pellentesque elit ullamcorper dignissim cras.
                                                    Vitae ultricies leo integer malesuada nunc vel.
                                                    Nibh cras pulvinar mattis nunc sed. Convallis a
                                                    cras semper auctor neque vitae tempus. Mattis
                                                    molestie a iaculis at erat pellentesque
                                                    adipiscing.
                                                </p>
                                                <div class="reply_btn">COMENTÁRIO</div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
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

    <div class="modal fade exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-users"></i> Integrantes de <b>Disciplina</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="integrantes-materia">
                        <span class="text-center">Professor(a):</span>
                        <li class="modal-professor">John Doe</li>
                        <span class="text-center">Alunos:</span>
                        <li class="modal-aluno-selecionado">John Doe</li>
                        <li>John Doe</li>
                        <li>John Doe</li>
                        <li>John Doe</li>
                        <li>John Doe</li>
                        <li>John Doe</li>
                        <li>John Doe</li>
                        <li>John Doe</li>
                        <li>John Doe</li>
                        <li>John Doe</li>
                        <li>John Doe</li>
                        <li>John Doe</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_dark" data-bs-dismiss="modal"><span><small>Fechar</small> <small>Fechar</small></span></button>
                </div>
            </div>
        </div>
    </div>

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
    <script>
        $(document).ready(function() {
            $('.contador').click(function(event) {
                event.stopPropagation(); // Impede a propagação do clique para outros elementos
                var likeCountElem = $(this).find('.like_count');
                var currentCount = parseInt(likeCountElem.text());
                likeCountElem.text(currentCount + 1);
            });
        });
    </script>

</body>

</html>