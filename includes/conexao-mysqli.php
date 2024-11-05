<?php

function conectaMysqli() {

    /* Conecta-se ao banco de dados MySQL */
    $mysqli = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO);

    if ($mysqli) {
        mysqli_set_charset($mysqli, "utf8");
        error_log("CONEXAO OK!");
    } else {
        error_log("ERRO AO CONECTAR AO BANCO: " . mysqli_connect_error());
    }

    return $mysqli;
}
?>