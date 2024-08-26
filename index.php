<?php

error_reporting(0);
// date_default_timezone_set('America/Sao_Paulo');
// $data_hora_atual = date("Y-m-d H:i:s");

include 'funcoes/config.php';
include 'includes/conexao.php';

// $Conexao = conecta();

$getUrl = strip_tags(trim(filter_input(INPUT_GET, "url", FILTER_DEFAULT)));
$Url = explode("/", $getUrl);

switch ($Url[0]) {
    case "":
    case "login":
        $pagina = "login";
        $parametro = "";
        break;
    case "periodos-professor":
        $pagina = "periodos-professor";
        $parametro = "";
        break;
    case "disciplinas-professor":
        $pagina = "disciplinas-professor";
        $parametro = "";
        break;
    case "duvidas-professor":
        $pagina = "duvidas-professor";
        $parametro = "";
        break;
    case "disciplinas-aluno":
        $pagina = "disciplinas-aluno";
        $parametro = "";
        break;
    case "duvidas-aluno":
        $pagina = "duvidas-aluno";
        $parametro = "";
        break;
    case "politica-privacidade":
        $pagina = "politica-privacidade";
        $parametro = "";
        break;
    default:
        $pagina = "404";
        $parametro = "";
        break;
}

if (file_exists("funcoes/views/$pagina.php")) {
    include "funcoes/views/$pagina.php";
} else {
    include "funcoes/views/404.php";
}
