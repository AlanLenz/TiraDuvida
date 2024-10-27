<!doctype html>
<html lang="pt-br">

<head>
    <?php
    // HEAD
    include 'includes/head.php';
    ?>
    <title><?php echo TITULO ?></title>
</head>

<body>

    <?php
    // PRELOADER
    include 'includes/preloader.php';
    ?>

    <div class="page_wrapper">

        <header class="site_header site_header_1">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col col-lg-3 col-5">
                        <div class="site_logo">
                            <img src="<?php echo URL . "assets/images/logo.png" ?>" title="<?php echo TITULO ?>" alt="<?php echo "Logo " . TITULO ?>">
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="page_content">
            <section class="register_section section_space_lg">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col col-lg-5">
                            <h1 class="register_heading text-center">Acesse sua conta</h1>
                            <p class="register_heading_description text-center">
                                Insira abaixo seu usuário e senha
                            </p>
                            <form id="formLoginUser">
                                <div class="register_form signup_login_form">
                                    <div class="form_item">
                                        <input type="text" id="iUser" name="nUser" placeholder="Usuário">
                                    </div>
                                    <div class="form_item">
                                        <input id="iPass" name="nPass" type="password" class="form-control" placeholder="Senha">
                                        <span toggle="#iPass" class="far fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                    <div id="aviso_erro">Usuário ou senha incorretos</div>
                                    <button id="buttonLoginUser" type="submit" class="btn btn_dark mb-5">
                                        <span>
                                            <small>Entrar</small>
                                            <small>Entrar</small>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
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
    ?>

    <link href="<?php echo URL . "assets/css/sweetalert.min.css" ?>" rel="stylesheet">

    <?php
    // SCRIPTS
    include 'includes/js.php';
    ?>

    <script src="<?php echo URL . "assets/js/sweetalert.min.js" ?>"></script>
    <script src="<?php echo URL . "funcoes/js/login.js" ?>"></script>
    <script src="<?php echo URL . "funcoes/scripts/login.js" ?>"></script>

</body>

</html>