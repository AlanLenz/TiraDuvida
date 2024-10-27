<?php

function conectaMysqli() {

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