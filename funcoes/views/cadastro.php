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
                            <img src="<?php echo URL . "assets/images/logo-header.webp" ?>" title="<?php echo TITULO ?>" alt="<?php echo "Logo " . TITULO ?>">
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
                            <h1 class="register_heading text-center">Cadastre-se</h1>
                            <p class="register_heading_description text-center">
                                Insira abaixo seu usuário e senha
                            </p>
                            <form id="formLoginUser">
                                <div class="register_form signup_login_form">
                                <input type="hidden" id="iCdUser" name="nCdUser" value="<?php echo $id ?>" />
                                    <div class="form_item">
                                        <input type="text" id="iUser" name="nUser" placeholder="Usuário" required>
                                    </div>
                                    <div class="form_item">
                                        <input id="iPass" name="nPass" type="password" class="form-control" placeholder="Senha" required>
                                        <span toggle="#iPass" class="far fa-fw fa-eye-slash field-icon toggle-password"></span>
                                    </div>
                                    <div class="form_item">
                                        <input id="iConfirmPass" name="nConfirmPass" type="password" class="form-control" placeholder="Confirme a Senha" required>
                                        <span toggle="#iConfirmPass" class="far fa-fw fa-eye-slash field-icon toggle-password"></span>
                                    </div>
                                    <button id="buttonLoginUser" type="submit" class="btn btn_dark mb-2">
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