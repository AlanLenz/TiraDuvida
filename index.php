<?php

error_reporting(0);
date_default_timezone_set('America/Sao_Paulo');

include 'src/config.php';
include 'includes/conexaoMysqli.php';

$conexaoMysqli = conectaMysqli();

$getUrl = strip_tags(trim(filter_input(INPUT_GET, "url", FILTER_DEFAULT)));
$Url = explode("/", $getUrl);

switch ($Url[0]) {
    case "":
    case "login":
        $pagina = "login";
        break;
    case "periodosProfessor":
        $pagina = "periodosProfessor";
        break;
    case "disciplinasProfessor":
        $pagina = "disciplinasProfessor";
        break;
    case "duvidasProfessor":
        $pagina = "duvidasProfessor";
        break;
    case "disciplinasAluno":
        $pagina = "disciplinasAluno";
        break;
    case "duvidasAluno":
        $pagina = "duvidasAluno";
        break;
    case "politicaPrivacidade":
        $pagina = "politicaPrivacidade";
        break;
    default:
        $pagina = "404";
        break;
}

if (file_exists("src/views/$pagina.php")) {
    include "src/views/$pagina.php";
} else {
    include "src/views/404.php";
}
