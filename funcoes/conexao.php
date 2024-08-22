<?php

// VARIÁVEIS DE AMBIENTE
define("TITULO", "TiraDúvida");
define("URL", "/tiraduvida/");
define("SERVIDOR", "localhost");
define("BANCO", "tiraduvida");
define("USUARIO", "root");
define("SENHA", "server");

$conn = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO);
mysqli_set_charset($conn, "utf8");

if (!$conn) {
    error_log("ERRO AO CONECTAR AO BANCO!");
} else {
    error_log("CONEXAO OK!");
}