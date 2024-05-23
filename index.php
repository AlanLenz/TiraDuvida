<?php

error_reporting(0);
date_default_timezone_set('America/Sao_Paulo');
$data_hora_atual = date("Y-m-d H:i:s");

$getUrl = strip_tags(trim(filter_input(INPUT_GET, "url", FILTER_DEFAULT)));
$Url = explode("/", $getUrl);

if ($Url[0] == "" || $Url[0] == "login") {
    $pagina = "login";
    $parametro = "";
} else if ($Url[0] == "periodos-professor") {
    $pagina = "periodos-professor";
    $parametro = "";
} else if ($Url[0] == "disciplinas-professor") {
    $pagina = "disciplinas-professor";
    $parametro = "";
} else if ($Url[0] == "duvidas-professor") {
    $pagina = "duvidas-professor";
    $parametro = "";
} else if ($Url[0] == "disciplinas-aluno") {
    $pagina = "disciplinas-aluno";
    $parametro = "";
} else if ($Url[0] == "duvidas-aluno") {
    $pagina = "duvidas-aluno";
    $parametro = "";
} else if ($Url[0] == "politica-privacidade") {
    $pagina = "politica-privacidade";
    $parametro = "";
} else {
    $pagina = "404";
    $parametro = "";
}

if (file_exists("pages/$pagina.php")) {
    include "pages/$pagina.php";
} else {
    include "pages/404.php";
}
