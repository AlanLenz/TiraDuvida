<?php
session_start();

if ($_SESSION['tipo_usuario'] == "A") {
    $linkPaginaInicial = "disciplinas-aluno";
} else if ($_SESSION['tipo_usuario'] == "P" || $_SESSION['tipo_usuario'] == "C") {
    $linkPaginaInicial = "periodos-professor";
} else {
    $linkPaginaInicial = "login";
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <?php
    // HEAD
    include 'includes/head.php';
    ?>
    <title><?php echo "Página não encontrada - " . TITULO ?></title>
</head>

<body>

    <?php
    // PRELOADER
    include 'includes/preloader.php';
    ?>

    <div class="page_wrapper">
        <main class="page_content">
            <section class="register_section page-404">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col col-lg-5">
                            <div class="site_logo">
                                <img src="<?php echo URL . "assets/images/logo.webp" ?>" title="<?php echo TITULO ?>" alt="<?php echo "Logo " . TITULO ?>">
                            </div>
                            <h1 class="register_heading text-center">Erro 404</h1>
                            <p class="register_heading_description text-center">
                                A página que você estava buscando não existe.
                            </p>
                            <a href="<?php echo URL . $linkPaginaInicial ?>" class="btn btn_white mb-5">
                                <span>
                                    <small>Voltar a página inicial</small>
                                    <small>Voltar a página inicial</small>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php
    // CSS
    include 'includes/css.php';

    // JS
    include 'includes/js.php';
    ?>

</body>

</html>