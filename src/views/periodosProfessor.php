<?php
session_start();

if (isset($_SESSION['usuario_id']) && isset($_SESSION['usuario_login']) && ($_SESSION['tipo_usuario'] == "P")) {
    $usuario_id = $_SESSION['usuario_id'];
    $usuario_login = $_SESSION['usuario_login'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    $vsSqlCurso = "SELECT DS_CURSO FROM curso";
    $vrsExecutaCurso = mysqli_query($conexaoMysqli, $vsSqlCurso) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($conexaoMysqli));

    $vsSqlProfessor = "
        SELECT
            p.CD_PROFESSOR,
            p.NM_PROFESSOR
        FROM
            professor p
        WHERE
            p.CD_USUARIO = '$usuario_id'
    ";
    $vrsExecutaProfessor = mysqli_query($conexaoMysqli, $vsSqlProfessor);
    if (mysqli_num_rows($vrsExecutaProfessor) == 1) {
        while ($voResultadoProfessor = mysqli_fetch_object($vrsExecutaProfessor)) {
            $_SESSION['professor_id'] = $voResultadoProfessor->CD_PROFESSOR;
            $_SESSION['professor_nm'] = $voResultadoProfessor->NM_PROFESSOR;
        }
    }

    $vsSqlProfessorPeriodos = "
        SELECT
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
        GROUP BY
            d.NR_PERIODO
    ";
    $vrsExecutaProfessorPeriodos = mysqli_query($conexaoMysqli, $vsSqlProfessorPeriodos);
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
    <title><?php echo "Períodos - " . TITULO ?></title>
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
                            <li class="nome_aluno"><?php echo "Olá, Professor(a) " .  $_SESSION['professor_nm'] ?></li>
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
                                <li><button class="abre_modal_logoff" type="button"><i class="far fa-reply"></i> Voltar à página de login</a></li>
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
                        while ($voResultadoProfessorPeriodos = mysqli_fetch_object($vrsExecutaProfessorPeriodos)) {
                        ?>
                            <div class="col-lg-6">
                                <div class="course_card list_layout">
                                    <div class="item_image">
                                        <a href="<?php echo URL . "disciplinasProfessor?curso=" . $voResultadoProfessorPeriodos->CD_CURSO . "&periodo=" . $voResultadoProfessorPeriodos->NR_PERIODO ?>" data-cursor-text="View">
                                            <img src="<?php echo URL . "assets/images/logo-curso-eng-software-square.webp" ?>" title="<?php echo $voResultadoProfessorPeriodos->DS_CURSO . " - " . $voResultadoProfessorPeriodos->NR_PERIODO . "º Período" ?>" alt="<?php echo "Logo " . $voResultadoProfessorPeriodos->DS_CURSO ?>">
                                        </a>
                                    </div>
                                    <div class="item_content">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <ul class="item_category_list unordered_list">
                                                <li><a href="<?php echo URL . "disciplinasProfessor?curso=" . $voResultadoProfessorPeriodos->CD_CURSO . "&periodo=" . $voResultadoProfessorPeriodos->NR_PERIODO ?>"><?php echo $voResultadoProfessorPeriodos->NR_PERIODO . "º Período" ?></a></li>
                                            </ul>
                                        </div>
                                        <h3 class="item_title">
                                            <a href="<?php echo URL . "disciplinasProfessor?curso=" . $voResultadoProfessorPeriodos->CD_CURSO . "&periodo=" . $voResultadoProfessorPeriodos->NR_PERIODO ?>">
                                                <?php echo $voResultadoProfessorPeriodos->DS_CURSO ?>
                                            </a>
                                        </h3>
                                        <a class="btn_unfill" href="<?php echo URL . "disciplinasProfessor?curso=" . $voResultadoProfessorPeriodos->CD_CURSO . "&periodo=" . $voResultadoProfessorPeriodos->NR_PERIODO ?>">
                                            <span class="btn_text">Acessar disciplinas</span>
                                            <span class="btn_icon">
                                                <i class="fas fa-long-arrow-right"></i>
                                                <i class="fas fa-long-arrow-right"></i>
                                            </span>
                                        </a>
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