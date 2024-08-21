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
    <title>TiraDúvida</title>
</head>

<body>

    <div class="page_wrapper">
        <div class="backtotop">
            <a href="#" class="scroll">
                <i class="far fa-arrow-up"></i>
            </a>
        </div>

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
                                <div class="register_form signup_login_form">
                                    <div id="errorMessage" style="display: none;">Usuário ou senha incorretos</div>
                                    <div class="form_item">
                                        <input type="text" id="emailUser" name="emailUser" placeholder="Usuário">
                                    </div>
                                    <div class="form_item">
                                        <input id="passwordUser" type="password" class="form-control" name="passwordUser" placeholder="Senha">
                                        <span toggle="#passwordUser" class="far fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                    <div class="remenber_forget">
                                        <div class="forget_password">
                                            <button type="button" data-bs-toggle="modal" data-bs-target=".exampleModal">Esqueci minha senha</a>
                                        </div>
                                    </div>
                                    <button id="buttonLoginUser" type="submit" class="btn btn_dark">
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
                    <p class="copyright_text text-center mb-0">Copyright 2024 © TiraDúvida. Todos direitos reservados | <a href="politica-privacidade">Política de privacidade</a>.</p>
                </div>
            </div>
        </footer>
    </div>

    <div class="modal fade exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form id="form_esqueci_senha">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Insira seu usuário abaixo e lhe enviaremos<br/>um e-mail para redefinir sua senha</b></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form_item">
                            <input type="text" id="emailUser" name="emailUser" placeholder="Insira seu usuário aqui" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="botao_enviar_email" type="submit" class="btn btn_dark"><span><small>Enviar</small> <small>Enviar</small></span></button>
                    </div>
                </form>
            </div>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#botao_enviar_email").click(function() {
            Swal.fire({
                title: "Email enviado!",
                text: "Caso o usuário tenha sido informado corretamente você estará recebendo um e-mail em alguns instantes com as instruções para redefinir sua senha.",
                icon: "success"
            });
        });
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $(document).ready(function() {
            $('#formLoginUser').on('submit', function(event) {
                event.preventDefault(); // Impede o envio padrão do formulário

                // Obtém os valores dos campos de entrada
                var username = $('#emailUser').val();
                var password = $('#passwordUser').val();

                // Verifica as credenciais
                if (username === 'usuarioProfessor' && password === 'senhaProfessor') {
                    // Redireciona para a página desejada
                    window.location.href = 'periodos-professor';
                } else if (username === 'usuarioAluno' && password === 'senhaAluno') {
                    // Redireciona para a página desejada
                    window.location.href = 'disciplinas-aluno';
                } else {
                    // Exibe a mensagem de erro
                    $('#errorMessage').show();
                    $("#emailUser").css("border-color", "#ff0000");
                    $("#passwordUser").css("border-color", "#ff0000");
                }
            });
        });
    </script>

</body>

</html>