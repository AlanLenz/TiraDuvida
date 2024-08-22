<?php

// VARIÁVEIS DE AMBIENTE
define("TITULO", "TiraDúvida");
define("URL", "/tiraduvida/");
define("SERVIDOR", "localhost");
define("BANCO", "tiraduvida");
define("USUARIO", "root");
define("SENHA", "");

function conecta() {

    /* Conecta-se ao banco de dados MySQL */
    $mysqli = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO);
    mysqli_set_charset($mysqli, "utf8");

    if (!$mysqli) {
        error_log("ERRO AO CONECTAR AO BANCO!");
    } else {
        error_log("CONEXAO OK!");
    }

    return $mysqli;
}

?>