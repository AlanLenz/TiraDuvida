<!doctype html>
<html lang="pt-br">

<head>
    <?php
    // HEAD
    include 'includes/head.php';
    ?>
    <title><?php echo "Disciplinas - " . TITULO ?></title>
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

    $vsSqlCurso = "SELECT DS_CURSO FROM curso WHERE CD_CURSO = $curso_id";
    $vrsExecutaCurso = mysqli_query($conexaoMysqli, $vsSqlCurso) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));

    $vsSqlDisciplinasProfessor = "
        SELECT
            c.CD_CURSO,
            c.DS_CURSO,
            d.CD_DISCIPLINA,
            d.NR_PERIODO,
            d.DS_DISCIPLINA,
            CASE d.CD_TURNO
                WHEN 'N' THEN 'Noturno'
                WHEN 'V' THEN 'Verspertino'
                WHEN 'M' THEN 'Matutino'
                WHEN 'I' THEN 'Integral'
                ELSE ''
            END AS DS_TURNO
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
            AND d.ST_DISCIPLINA = 'A'
    ";
    $vrsExecutaDisciplinasProfessor = mysqli_query($conexaoMysqli, $vsSqlDisciplinasProfessor) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));
    $viNumRowsDisciplinasProfessor = mysqli_num_rows($vrsExecutaDisciplinasProfessor);
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
                            <img src="<?php echo URL . "assets/images/logo.png" ?>" title="<?php echo TITULO ?>" alt="<?php echo "Logo " . TITULO ?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-2">
                        <div class="title_page">
                            <?php while ($voResultadoCurso = mysqli_fetch_object($vrsExecutaCurso)) { ?>
                                <h2><?php echo $voResultadoCurso->DS_CURSO ?></h2>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col col-lg-3 col-5">
                        <ul class="header_btns_group unordered_list_end">
                            <li>
                                <button class="mobile_menu_btn" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="far fa-bars"></i>
                                </button>
                            </li>
                            <li class="nome_aluno"><?php echo "Olá, Professor(a)" . $professor_nm ?></li>
                            <li class="nome_aluno"> | </li>
                            <div class="dropdown">
                                <li>
                                    <button class="btn btn-dropdown-menu dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="<?php echo URL . "periodos-professor" ?>">Períodos</a></li>
                                        <li><button type="button" id="abre_modal_logoff" class="dropdown-item logoff-button"><i class="far fa-sign-out-alt" title="Sair"></i> Sair</button></li>
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
                            <ul class="breadcrumb_nav unordered_list">
                                <li><a href="periodos-professor"><i class="far fa-reply"></i> Voltar à página de períodos</a></li>
                            </ul>
                            <h1 class="page_title"><?php echo "Disciplinas " . $periodo . "º período" ?></h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="event_section section_space_lg">
                <div class="container">
                    <div class="row">
                        <?php
                        // LISTAGEM DE DISCIPLINAS
                        while ($voResultadoDisciplinasProfessor = mysqli_fetch_object($vrsExecutaDisciplinasProfessor)) {
                        ?>
                            <div class="col col-lg-4">
                                <div class="event_card">
                                    <a class="item_image" href="<?php echo URL . "duvidas-professor?curso=" . $voResultadoDisciplinasProfessor->CD_CURSO . "&periodo=" . $voResultadoDisciplinasProfessor->NR_PERIODO . "&disciplina=" . $voResultadoDisciplinasProfessor->CD_DISCIPLINA ?>">
                                        <img src="<?php echo URL . "assets/images/logo-curso-eng-software.webp" ?>" title="<?php echo $voResultadoDisciplinasProfessor->DS_DISCIPLINA ?>" alt="<?php echo "Logo " . $voResultadoDisciplinasProfessor->DS_DISCIPLINA ?>">
                                    </a>
                                    <div class="item_content">
                                        <h3 class="item_title">
                                            <a href="<?php echo URL . "duvidas-professor?curso=" . $voResultadoDisciplinasProfessor->CD_CURSO . "&periodo=" . $voResultadoDisciplinasProfessor->NR_PERIODO . "&disciplina=" . $voResultadoDisciplinasProfessor->CD_DISCIPLINA ?>">
                                                <?php echo $voResultadoDisciplinasProfessor->DS_DISCIPLINA ?>
                                            </a>
                                        </h3>
                                        <ul class="header_btns_group unordered_list">
                                            <li><a href="<?php echo URL . "duvidas-professor?curso=" . $voResultadoDisciplinasProfessor->CD_CURSO . "&periodo=" . $voResultadoDisciplinasProfessor->NR_PERIODO . "&disciplina=" . $voResultadoDisciplinasProfessor->CD_DISCIPLINA ?>" class="btn btn_dark"><span><small>Acessar disciplina</small> <small>Acessar disciplina</small></span></a></li>
                                            <li><button type="button" onclick="abre_modal_alunos(<?php echo '\'' . $voResultadoDisciplinasProfessor->CD_DISCIPLINA . '\'' ?>)" class="btn border_dark"><span><small>Visualizar integrantes</small> <small>Visualizar integrantes</small></span></button></li>
                                        </ul>
                                        <ul class="meta_info_list unordered_list_block">
                                            <li>
                                                <div>
                                                    <i class="far fa-chalkboard-teacher"></i>
                                                    <span>Professor(a)</span>
                                                </div>
                                                <span class="text-end"><?php echo $professor_nm ?></span>
                                            </li>
                                            <li>
                                                <div>
                                                    <i class="far fa-list-ol"></i>
                                                    <span>Código</span>
                                                </div>
                                                <span class="text-end"><?php echo $voResultadoDisciplinasProfessor->CD_DISCIPLINA ?></span>
                                            </li>
                                            <li>
                                                <div>
                                                    <i class="far fa-calendar-alt"></i>
                                                    <span>Período / Turno</span>
                                                </div>
                                                <span class="text-end"><?php echo $voResultadoDisciplinasProfessor->NR_PERIODO . 'º / ' . $voResultadoDisciplinasProfessor->DS_TURNO ?></span>
                                            </li>
                                            <li>
                                                <div>
                                                    <i class="far fa-calendar-alt"></i>
                                                    <span>Dúvidas enviadas</span>
                                                </div>
                                                <?php
                                                $vsSqlDuvidasEnviadas = "SELECT count(*) AS NUMERO_DUVIDAS_ENVIADAS FROM duvida WHERE CD_DISCIPLINA = '$voResultadoDisciplinasProfessor->CD_DISCIPLINA'";
                                                $vrsExecutaDuvidasEnviadas = mysqli_query($conexaoMysqli, $vsSqlDuvidasEnviadas) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));
                                                while ($voResultadoDuvidasEnviadas = mysqli_fetch_object($vrsExecutaDuvidasEnviadas)) {
                                                ?>
                                                    <span class="text-end"><?php echo $voResultadoDuvidasEnviadas->NUMERO_DUVIDAS_ENVIADAS ?></span>
                                                <?php } ?>
                                            </li>
                                            <li>
                                                <div>
                                                    <i class="far fa-question"></i>
                                                    <span>Dúvidas pendentes</span>
                                                </div>
                                                <?php
                                                $vsSqlDuvidasPendentes = "SELECT count(*) AS NUMERO_DUVIDAS_PENDENTES FROM duvida WHERE ST_DUVIDA = 'P' AND CD_DISCIPLINA = '$voResultadoDisciplinasProfessor->CD_DISCIPLINA'";
                                                $vrsExecutaDuvidasPendentes = mysqli_query($conexaoMysqli, $vsSqlDuvidasPendentes) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));
                                                while ($voResultadoDuvidasPendentes = mysqli_fetch_object($vrsExecutaDuvidasPendentes)) {
                                                ?>
                                                    <span class="text-end"><?php echo $voResultadoDuvidasPendentes->NUMERO_DUVIDAS_PENDENTES ?></span>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
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
        ?>

        <div class="modal fade" id="modal_visualizar_alunos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="far fa-eye fa-fw"></i> <span id="dsDisciplina"></span></h5>
                    </div>
                    <div class="modal-body">
                        <p><span id="nmAluno"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php
    // CSS
    include 'includes/css.php';

    // JS
    include 'includes/js.php';
    ?>

    <script src="<?php echo URL . "funcoes/js/modalAluno.js" ?>"></script>

</body>

</html>