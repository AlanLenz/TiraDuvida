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
    <title>Períodos - TiraDúvida</title>
</head>

<?php
session_start();

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

    if (mysqli_num_rows($professor_exec) == 1) {
        while ($result = mysqli_fetch_object($professor_exec)) {
            $_SESSION['professor_id'] = $result->CD_PROFESSOR;
            $_SESSION['professor_nm'] = $result->NM_PROFESSOR;
        }
    }

    $prof_periodo_qry = "SELECT
	        c.CD_CURSO,
            c.DS_CURSO,            
            d.NR_PERIODO            
        FROM
	        curso c,
            disciplina d,
            professor_disciplina pd
        WHERE
            pd.CD_USUARIO = '$usuario_id' 
            AND pd.ST_PF_DISCIPLINA = 'A' 
            AND pd.CD_DISCIPLINA = d.CD_DISCIPLINA
            AND d.ST_DISCIPLINA = 'A'
        GROUP BY d.NR_PERIODO";

    $prof_periodo_exec = mysqli_query($mysqli, $prof_periodo_qry);

    if (mysqli_num_rows($prof_periodo_exec) >= 1) {

        $qtdPeriodo = 0;
        while ($dados_periodo = mysqli_fetch_array($prof_periodo_exec)) {
            $cdCurso[$qtdPeriodo]        = $dados_periodo['CD_CURSO'];
            $dsCurso[$qtdPeriodo]        = $dados_periodo['DS_CURSO'];
            $nrPeriodo[$qtdPeriodo]      = $dados_periodo['NR_PERIODO'];
            $qtdPeriodo++;
        }
    } else {
        echo "Nenhum período com disciplina ativa encontrado para este professor.";
    }
} else {
    echo "Usuário não está logado!";
    header("Location: login");
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
                            <h2>Períodos</h2>
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
                            <ul class="breadcrumb_nav unordered_list">
                                <li><a href="login"><i class="far fa-reply"></i> Voltar à página inicial</a></li>
                            </ul>
                            <h1 class="page_title">Períodos</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="courses_archive_section section_space_lg">
                <div class="container">
                    <div class="row">
                        <?php

                        // <img src="assets/images/logo-curso-ia.jpg" -> img curso ia
                        for ($i = 0; $i < $qtdPeriodo; $i++) {

                            echo '
                                <div class="col-lg-6">
                                    <div class="course_card list_layout">
                                        <div class="item_image">
                                            <a href="disciplinas-professor?curso=' . $cdCurso[$i] . '&periodo=' . $nrPeriodo[$i] . '" data-cursor-text="View">
                                                <img src="assets/images/logo-curso-eng-software.jpg" alt="Collab – Online Learning Platform">
                                            </a>
                                        </div>
                                        <div class="item_content">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <ul class="item_category_list unordered_list">
                                                    <li><a href="disciplinas-professor?curso=' . $cdCurso[$i] . '&periodo=' . $nrPeriodo[$i] . '">' . $nrPeriodo[$i] . 'º Período</a></li>
                                                </ul>
                                            </div>
                                            <h3 class="item_title">
                                                <a href="disciplinas-professor?curso=' . $cdCurso[$i] . '&periodo=' . $nrPeriodo[$i] . '">
                                                    ' . $dsCurso[$i] . '
                                                </a>
                                            </h3>
                                            <a class="btn_unfill" href="disciplinas-professor?curso=' . $cdCurso[$i] . '&periodo=' . $nrPeriodo[$i] . '">
                                                <span class="btn_text">Acessar disciplinas</span>
                                                <span class="btn_icon">
                                                    <i class="fas fa-long-arrow-right"></i>
                                                    <i class="fas fa-long-arrow-right"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            ';
                        } ?>
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

</body>

</html>