<?php

// error_reporting(0);
date_default_timezone_set('America/Sao_Paulo');
// $data_hora_atual = date("Y-m-d H:i:s");

include 'funcoes/config.php';
include_once($_SERVER['DOCUMENT_ROOT']. URL . 'includes/conexao-mysqli.php');

$conexaoMysqli = conectaMysqli();

$getUrl = strip_tags(trim(filter_input(INPUT_GET, "url", FILTER_DEFAULT)));
$Url = explode("/", $getUrl);

switch ($Url[0]) {
    case "":
    case "login":
        $pagina = "login";
        break;
    case "periodos-professor":
        $pagina = "periodos-professor";
        break;
    case "disciplinas-professor":
        $pagina = "disciplinas-professor";
        break;
    case "duvidas-professor":
        $pagina = "duvidas-professor";
        break;
    case "disciplinas-aluno":
        $pagina = "disciplinas-aluno";
        break;
    case "duvidas-aluno":
        $pagina = "duvidas-aluno";
        break;
    case "politica-privacidade":
        $pagina = "politica-privacidade";
        break;
    default:
        $pagina = "404";
        break;
}

if (file_exists("funcoes/views/$pagina.php")) {
    include "funcoes/views/$pagina.php";
} else {
    include "funcoes/views/404.php";
}
