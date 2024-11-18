<?php

session_start();

if (isset($_SESSION['usuario_id']) && isset($_SESSION['usuario_login']) && isset($_SESSION['tipo_usuario'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    if ($tipo_usuario == "A") {
        $vsSqlUsuario = "SELECT a.NM_ALUNO AS NM_USUARIO FROM aluno a WHERE a.CD_USUARIO = '$usuario_id'";
        $vrsExecutaUsuario = mysqli_query($conexaoMysqli, $vsSqlUsuario);
    } else if ($tipo_usuario == "P" || $tipo_usuario == "C") {
        $vsSqlUsuario = "SELECT p.NM_PROFESSOR AS NM_USUARIO FROM professor p WHERE p.CD_USUARIO = '$usuario_id'";
        $vrsExecutaUsuario = mysqli_query($conexaoMysqli, $vsSqlUsuario);
    } else {
        header("Location: login");
    }
} else {
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
    <title><?php echo "Política de privacidade - " . TITULO ?></title>
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
                            <h2>Política de privacidade</h2>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 col-md-5">
                        <ul class="header_btns_group unordered_list_end">
                            <li>
                                <button class="mobile_menu_btn" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="far fa-bars"></i>
                                </button>
                            </li>
                            <?php while ($voResultadoUsuario = mysqli_fetch_object($vrsExecutaUsuario)) { ?>
                                <li class="nome_aluno">
                                    <?php echo $tipo_usuario == "A" ? "Olá, " : "Olá, Professor(a)"; echo $voResultadoUsuario->NM_USUARIO ?>
                                </li>
                            <?php } ?>
                            <li class="nome_aluno"> | </li>
                            <div class="dropdown">
                                <li>
                                    <button class="btn btn-dropdown-menu dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                        <?php if ($tipo_usuario == "A") { ?>
                                            <li><a class="dropdown-item" href="<?php echo URL . "disciplinasAluno" ?>">Disciplinas</a></li>
                                        <?php } else if ($tipo_usuario == "P" || $tipo_usuario == "C") { ?>
                                            <li><a class="dropdown-item" href="<?php echo URL . "periodosProfessor" ?>">Períodos</a></li>
                                        <?php } ?>
                                        <li><button type="button" class="abre_modal_logoff dropdown-item logoff-button"><i class="far fa-sign-out-alt" title="Sair"></i> Sair</button></li>
                                    </ul>
                                </li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <main class="page_content">
            <section class="register_section section_space_md">
                <div class="container">
                    <div class="register_heading_description text-justify">
                        <p>
                            Política de Privacidade da <?php echo TITULO ?>
                            <br />
                            Última atualização: 15/10/2024
                            <br />
                            A <?php echo TITULO ?> valoriza a privacidade dos seus usuários e está comprometida em proteger as informações pessoais que coletamos. Esta Política de Privacidade descreve como coletamos, usamos, compartilhamos e protegemos as suas informações pessoais quando você utiliza nossos serviços.
                        </p>
                        <p>
                            1. Coleta de Informações
                        </p>
                        <p>
                            Podemos coletar informações pessoais quando você interage com nossos serviços, como:
                        </p>
                        <ul>
                            <li>Nome</li>
                            <li>Dados de uso (incluindo informações sobre como você utiliza nosso site)</li>
                            <li>Informações fornecidas por você em formulários ou pesquisas</li>
                        </ul>
                        <p>
                            2. Uso das Informações
                        </p>
                        <p>
                            Utilizamos as informações coletadas para:
                        </p>
                        <ul>
                            <li>Fornecer e melhorar nossos serviços</li>
                            <li>Personalizar a sua experiência</li>
                            <li>Enviar comunicações, incluindo newsletters e atualizações</li>
                            <li>Analisar o uso de nossos serviços para melhorar a performance e a funcionalidade</li>
                            <li>Responder às suas dúvidas e solicitações</li>
                        </ul>
                        <p>
                            3. Compartilhamento de Informações
                        </p>
                        <p>
                            A <?php echo TITULO ?> não vende, aluga ou compartilha suas informações pessoais com terceiros, exceto nas seguintes circunstâncias:
                        </p>
                        <ul>
                            <li>Quando temos o seu consentimento explícito</li>
                            <li>Para cumprir obrigações legais ou regulatórias</li>
                            <li>Para proteger os direitos, propriedade ou segurança da <?php echo TITULO ?>, nossos usuários ou o público</li>
                            <li>Com prestadores de serviços que nos ajudam a operar e melhorar nossos serviços, desde que esses prestadores estejam sujeitos a obrigações de confidencialidade</li>
                        </ul>
                        <p>
                            4. Proteção de Informações
                        </p>
                        <p>
                            Adotamos medidas de segurança adequadas para proteger suas informações pessoais contra acesso não autorizado, alteração, divulgação ou destruição. No entanto, nenhum método de transmissão pela Internet ou de armazenamento eletrônico é 100% seguro, e não podemos garantir a segurança absoluta.
                        </p>
                        <p>
                            5. Seus Direitos
                        </p>
                        <p>
                            Você tem o direito de:
                        </p>
                        <ul>
                            <li>Acessar as informações pessoais que mantemos sobre você</li>
                            <li>Solicitar a correção de informações pessoais incorretas ou incompletas</li>
                            <li>Solicitar a exclusão de suas informações pessoais, salvo quando a retenção for necessária por motivos legais</li>
                            <li>Optar por não receber comunicações de marketing</li>
                        </ul>
                        <p>
                            6. Cookies e Tecnologias Semelhantes
                        </p>
                        <p>
                            Utilizamos cookies e tecnologias semelhantes para coletar informações sobre o uso do nosso site e para melhorar a sua experiência. Você pode configurar o seu navegador para recusar cookies, mas isso pode afetar a funcionalidade dos nossos serviços.
                        </p>
                        <p>
                            7. Alterações na Política de Privacidade
                        </p>
                        <p>
                            Podemos atualizar esta Política de Privacidade periodicamente. Notificaremos você sobre mudanças significativas publicando a nova política em nosso site e, se aplicável, através de outros canais de comunicação.
                        </p>
                        <p>
                            8. Contato
                        </p>
                        <p>
                            Se você tiver dúvidas ou preocupações sobre esta Política de Privacidade ou sobre nossas práticas de privacidade, entre em contato conosco:
                        </p>
                        <ul>
                            <li>E-mail: contato@tiraduvida.net.br</li>
                            <li>Endereço: Av. Brasil, 1000, Cascavel - PR</li>
                            <li>Agradecemos por confiar na <?php echo TITULO ?> para suas necessidades de aprendizado e esclarecimento de dúvidas. Estamos comprometidos em proteger a sua privacidade e em fornecer um serviço seguro e confiável.</li>
                        </ul>
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