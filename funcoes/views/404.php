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
                            <h1 class="register_heading text-center">Erro 404</h1>
                            <p class="register_heading_description text-center">
                                A página que você estava buscando não existe.
                            </p>
                            <a href="login" class="btn btn_dark mb-5">
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
    ?>

</body>

</html>