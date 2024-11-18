<?php

session_start();

if (isset($_SESSION['usuario_id']) && isset($_SESSION['usuario_login']) && ($_SESSION['tipo_usuario'] == "A")) {
    $usuario_id = $_SESSION['usuario_id'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    $vsSqlAluno = "SELECT a.NM_ALUNO FROM aluno a WHERE a.CD_USUARIO = '$usuario_id'";
    $vrsExecutaAluno = mysqli_query($conexaoMysqli, $vsSqlAluno);

    $vsSqlCurso = "
        SELECT
            c.DS_CURSO
        FROM
            curso c
        INNER JOIN
            aluno_disciplina ad ON ad.CD_CURSO = c.CD_CURSO
        WHERE
            ad.CD_USUARIO = '$usuario_id'
        LIMIT 1
    ";
    $vrsExecutaCurso = mysqli_query($conexaoMysqli, $vsSqlCurso);

    $vsSqlDisciplinasAluno = "
        SELECT
            c.CD_CURSO,
            d.CD_DISCIPLINA,
            d.NR_PERIODO,
            d.DS_DISCIPLINA,
            d.DS_DISCIPLINA,
            CASE d.CD_TURNO
                WHEN 'N' THEN 'Noturno'
                WHEN 'V' THEN 'Verspertino'
                WHEN 'M' THEN 'Matutino'
                WHEN 'I' THEN 'Integral'
                ELSE ''
            END AS DS_TURNO
        FROM
            disciplina d
            LEFT JOIN curso c ON d.CD_CURSO = c.CD_CURSO
            LEFT JOIN aluno_disciplina ad ON ad.CD_DISCIPLINA = d.CD_DISCIPLINA
            LEFT JOIN aluno a ON a.CD_USUARIO = ad.CD_USUARIO
        WHERE
            ad.CD_USUARIO = '$usuario_id' AND
            a.NR_PERIODO = d.NR_PERIODO AND
            ad.ST_AL_DISCIPLINA = 'A' AND
            d.ST_DISCIPLINA = 'A';
    ";
    $vrsExecutaDisciplinasAluno = mysqli_query($conexaoMysqli, $vsSqlDisciplinasAluno);
} else {
    echo "Usuário não está logado!";
    header("Location: login");
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <?php
    // HEAD
    include 'includes/head.php';
    ?>
    <title><?php echo "Disciplinas - " . TITULO ?></title>
</head>

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
                            <?php while ($voResultadoCurso = mysqli_fetch_object($vrsExecutaCurso)) { ?>
                                <h2><?php echo $voResultadoCurso->DS_CURSO ?></h2>
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
                            <?php while ($voResultadoAluno = mysqli_fetch_object($vrsExecutaAluno)) { ?>
                                <li class="nome_aluno"><?php echo "Olá, " . $voResultadoAluno->NM_ALUNO ?></li>
                            <?php } ?>
                            <li class="nome_aluno"> | </li>
                            <li class="logout">
                                <button class="abre_modal_logoff logoff-button" type="button">
                                    <i class="far fa-sign-out-alt" title="Sair"></i>
                                </button>
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
                                <li><button class="abre_modal_logoff" type="button"><i class="far fa-reply"></i> Voltar à página de login</button></li>
                            </ul>
                            <h1 class="page_title">Disciplinas</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="event_section section_space_lg">
                <div class="container">
                    <div class="row">
                        <?php
                        // LISTAGEM DE DISCIPLINAS
                        while ($voResultadoDisciplinasAluno = mysqli_fetch_object($vrsExecutaDisciplinasAluno)) {
                        ?>
                            <div class="col col-lg-4">
                                <div class="event_card">
                                    <a class="item_image" href="<?php echo URL . "duvidasAluno?curso=" . $voResultadoDisciplinasAluno->CD_CURSO . "&periodo=" . $voResultadoDisciplinasAluno->NR_PERIODO . "&disciplina=" . $voResultadoDisciplinasAluno->CD_DISCIPLINA ?>">
                                        <img src="<?php echo URL . "assets/images/logo-curso-eng-software.webp" ?>" alt="Collab – Online Learning Platform">
                                    </a>
                                    <div class="item_content">
                                        <h3 class="item_title">
                                            <a href="<?php echo URL . "duvidasAluno?curso=" . $voResultadoDisciplinasAluno->CD_CURSO . "&periodo=" . $voResultadoDisciplinasAluno->NR_PERIODO . "&disciplina=" . $voResultadoDisciplinasAluno->CD_DISCIPLINA ?>">
                                                <?php echo $voResultadoDisciplinasAluno->DS_DISCIPLINA ?>
                                            </a>
                                        </h3>
                                        <ul class="header_btns_group unordered_list justify-content-center">
                                            <li><a href="<?php echo URL . "duvidasAluno?curso=" . $voResultadoDisciplinasAluno->CD_CURSO . "&periodo=" . $voResultadoDisciplinasAluno->NR_PERIODO . "&disciplina=" . $voResultadoDisciplinasAluno->CD_DISCIPLINA ?>" class="btn btn_dark"><span><small>Acessar dúvidas da disciplina</small> <small>Acessar dúvidas da disciplina</small></span></a></li>
                                        </ul>
                                        <ul class="meta_info_list unordered_list_block">
                                            <li>
                                                <div>
                                                    <i class="far fa-chalkboard-teacher"></i>
                                                    <span>Professor(a)</span>
                                                </div>
                                                <?php
                                                $vsSqlProfessor = "SELECT p.NM_PROFESSOR FROM professor p LEFT JOIN professor_disciplina pd ON p.CD_USUARIO = pd.CD_USUARIO WHERE pd.CD_DISCIPLINA = '$voResultadoDisciplinasAluno->CD_DISCIPLINA'";
                                                $vrsExecutaProfessor = mysqli_query($conexaoMysqli, $vsSqlProfessor) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));
                                                while ($voResultadoProfessor = mysqli_fetch_object($vrsExecutaProfessor)) {
                                                ?>
                                                    <span class="text-end"><?php echo $voResultadoProfessor->NM_PROFESSOR ?></span>
                                                <?php
                                                }
                                                ?>
                                            </li>
                                            <li>
                                                <div>
                                                    <i class="far fa-list-ol"></i>
                                                    <span>Código</span>
                                                </div>
                                                <span class="text-end"><?php echo $voResultadoDisciplinasAluno->CD_DISCIPLINA ?></span>
                                            </li>
                                            <li>
                                                <div>
                                                    <i class="far fa-calendar-alt"></i>
                                                    <span>Período / Turno</span>
                                                </div>
                                                <span class="text-end"><?php echo $voResultadoDisciplinasAluno->NR_PERIODO . ' / ' . $voResultadoDisciplinasAluno->DS_TURNO ?></span>
                                            </li>
                                            <li>
                                                <div>
                                                    <i class="far fa-calendar-alt"></i>
                                                    <span>Dúvidas enviadas</span>
                                                </div>
                                                <?php
                                                $vsSqlDuvidasEnviadas = "SELECT count(*) AS NUMERO_DUVIDAS_ENVIADAS FROM duvida WHERE CD_DISCIPLINA = '$voResultadoDisciplinasAluno->CD_DISCIPLINA'";
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
                                                $vsSqlDuvidasPendentes = "SELECT count(*) AS NUMERO_DUVIDAS_PENDENTES FROM duvida WHERE ST_DUVIDA = 'P' AND CD_DISCIPLINA = '$voResultadoDisciplinasAluno->CD_DISCIPLINA'";
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

    </div>

    <?php
    // CSS
    include 'includes/css.php';

    // JS
    include 'includes/js.php';
    ?>

</body>

</html>