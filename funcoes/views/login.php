<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/images/favicon.webp">
    <?php
    // CSS
    include 'includes/css.php';
    ?>
    <title><?php echo TITULO ?></title>
</head>

<body>

    <div class="page_wrapper">

        <header class="site_header site_header_1">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col col-lg-3 col-5">
                        <div class="site_logo">
                            <img src="assets/images/logo.png" title="TiraDúvida" alt="TiraDúvida">
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
                                <input type="hidden" id="vsUrl" name="vsUrl" value="<?php echo URL ?>">
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

        <footer class="site_footer">
            <div class="footer_widget_area">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col col-lg-3 col-md-6 col-sm-6">
                            <div class="footer_widget">
                                <div class="site_logo">
                                    <img src="assets/images/logo.png" title="TiraDúvida" alt="TiraDúvida">
                                </div>
                                <p>Fale com seu professor agora!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright_widget">
                <div class="container">
                    <p class="copyright_text text-center mb-0"><?php echo "Copyright 2024 © " . TITULO . ". Todos direitos reservados | " ?><a href="politica-privacidade">Política de privacidade</a>.</p>
                </div>
            </div>
        </footer>
    </div>

    <?php
    // SCRIPTS
    include 'includes/scripts.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo URL . "funcoes/js/login.js" ?>"></script>
    <script src="<?php echo URL . "funcoes/scripts/login.js" ?>"></script>
</body>

</html>