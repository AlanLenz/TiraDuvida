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
    <title>disciplinas - TiraDúvida</title>
</head>

<?php

session_start();

if (isset($_SESSION['usuario_id']) && isset($_SESSION['usuario_login']) && isset($_SESSION['tipo_usuario'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $tipo_usuario = $_SESSION['tipo_usuario'];
    $professor_id = $_SESSION['professor_id'];
    $professor_nm = $_SESSION['professor_nm'];
    $curso_id = $_GET['curso'];
    $periodo = $_GET['periodo'];

    require_once 'includes/conexao-mysqli.php';

    $prof_disciplina_qry = "SELECT
    	        c.CD_CURSO,
                c.DS_CURSO,
                d.CD_TURNO,
                d.CD_DISCIPLINA,
                d.NR_PERIODO,
                d.DS_DISCIPLINA
            FROM
                curso c,
                disciplina d,
                professor_disciplina pd
            WHERE
                pd.CD_USUARIO = '$usuario_id'
                AND c.CD_CURSO = '$curso_id'
                AND d.NR_PERIODO = '$periodo' 
                AND pd.ST_PF_DISCIPLINA = 'A' 
                AND pd.CD_DISCIPLINA = d.CD_DISCIPLINA
                AND d.ST_DISCIPLINA = 'A'";

    $prof_disciplina_exec = mysqli_query($mysqli, $prof_disciplina_qry);

    if (mysqli_num_rows($prof_disciplina_exec) >= 1) {

        $qtdDisciplina = 0;
        while ($dados_disc = mysqli_fetch_array($prof_disciplina_exec)) {
            $cdCurso[$qtdDisciplina]        = $dados_disc['CD_CURSO'];
            $dsCurso[$qtdDisciplina]        = $dados_disc['DS_CURSO'];
            $cdTurno[$qtdDisciplina]        = $dados_disc['CD_TURNO'];
            $cdDisciplina[$qtdDisciplina]   = $dados_disc['CD_DISCIPLINA'];
            $nrPeriodo[$qtdDisciplina]      = $dados_disc['NR_PERIODO'];
            $dsDisciplina[$qtdDisciplina]   = $dados_disc['DS_DISCIPLINA'];
            $dvTotal[$qtdDisciplina]        = $dados_disc['DV_TOTAL'];
            $dvPendente[$qtdDisciplina]     = $dados_disc['DV_PENDENTE'];

            switch ($dados_disc['CD_TURNO']) {
                case 'N':
                    $dsTurno[$qtdDisciplina] = 'NOTURNO';
                    break;
                case 'V':
                    $dsTurno[$qtdDisciplina] = 'VESPERTINO';
                    break;
                case 'M':
                    $dsTurno[$qtdDisciplina] = 'MATUTINO';
                    break;
                case 'I':
                    $dsTurno[$qtdDisciplina] = 'INTEGRAL';
                    break;
                default:
                case 'N':
                    $dsTurno[$qtdDisciplina] = 'NAO IDENTIFICADO';
                    break;
            }

            $qtdDisciplina++;
        }
    } else {
        echo "Nenhuma disciplina ativa encontrada para este professor.";
    }
} else {
    echo "Usuário não está logado!";
    header("Location: login");
}

?>

<body>

    <input type="hidden" id="vsUrl" name="vsUrl" value="<?php echo URL ?>"></input>

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
                            <h2><?php echo $dsCurso[0] ?></h2>
                        </div>
                    </div>
                    <div class="col col-lg-3 col-5">
                        <ul class="header_btns_group unordered_list_end">
                            <li>
                                <button class="mobile_menu_btn" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="far fa-bars"></i>
                                </button>
                            </li>
                            <li class="nome_aluno">Olá, Professor(a) <?php echo $professor_nm ?></li>
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
                                <li><a href="periodos-professor"><i class="far fa-reply"></i> Voltar à página de períodos</a></li>
                            </ul>
                            <h1 class="page_title">Disciplinas <?php echo $periodo ?>º período</h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- <li><button type="button" data-bs-toggle="modal" data-bs-target=".exampleModal" class="btn border_dark"><span><small>Visualizar integrantes</small> <small>Visualizar integrantes</small></span></button></li> -->

            <section class="event_section section_space_lg">
                <div class="container">
                    <div class="row">
                        <?php
                        for ($i = 0; $i < $qtdDisciplina; $i++) {

                            echo '
                                <div class="col col-lg-4">
                            <div class="event_card">
                                    <a class="item_image" href="duvidas-professor?curso=' . $cdCurso[$i] . '&periodo=' . $nrPeriodo[$i] . '&disciplina=' . $cdDisciplina[$i] . '">                                    
                                        <img src="assets/images/logo-curso-eng-software.webp" title="Engenharia de Software" alt="Logo Engenharia de Software">
                                    </a>
                                <div class="item_content">
                                    <h3 class="item_title">
                                        <a href="duvidas-professor?curso=' . $cdCurso[$i] . '&periodo=' . $nrPeriodo[$i] . '&disciplina=' . $cdDisciplina[$i] . '">
                                            ' . $dsDisciplina[$i] . '
                                        </a>
                                    </h3>
                                    <ul class="header_btns_group unordered_list">
                                        <li><a href="duvidas-professor?curso=' . $cdCurso[$i] . '&periodo=' . $nrPeriodo[$i] . '&disciplina=' . $cdDisciplina[$i] . '" class="btn btn_dark"><span><small>Acessar disciplina</small> <small>Acessar disciplina</small></span></a></li>
                                        <li><button type="button" onclick="modalAluno(\'' . $cdDisciplina[$i] . '\', \'' . $dsDisciplina[$i] . '\', \'' . $professor_nm . '\')" class="btn border_dark"><span><small>Visualizar integrantes</small> <small>Visualizar integrantes</small></span></button></li>
                                    </ul>
                                    <ul class="meta_info_list unordered_list_block">
                                        <li>
                                            <div>
                                                <i class="far fa-chalkboard-teacher"></i>
                                                <span>Professor(a)</span>
                                            </div>
                                            <span class="text-end">' . $professor_nm . '</span>
                                        </li>
                                        <li>
                                            <div>
                                                <i class="far fa-list-ol"></i>
                                                <span>Código</span>
                                            </div>
                                            <span class="text-end">' . $cdDisciplina[$i] . '</span>
                                        </li>
                                        <li>
                                            <div>
                                                <i class="far fa-calendar-alt"></i>
                                                <span>Período / Turno</span>
                                            </div>
                                            <span class="text-end">' . $nrPeriodo[$i] . ' / ' . $dsTurno[$i] . '</span>
                                        </li>
                                        <li>
                                            <div>
                                                <i class="far fa-calendar-alt"></i>
                                                <span>Dúvidas enviadas</span>
                                            </div>
                                            <span class="text-end">' . $dvTotal[$i] . '</span>
                                        </li>
                                        <li>
                                            <div>
                                                <i class="far fa-question"></i>
                                                <span>Dúvidas pendentes</span>
                                            </div>
                                            <span class="text-end">' . $dvPendente[$i] . '</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>    
                            ';
                        }

                        ?>
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

    <script src="funcoes/js/modalAluno.js"></script>
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