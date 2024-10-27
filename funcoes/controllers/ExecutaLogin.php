<?php

require_once "../model/Login.class.php";

if (isset($_POST['nUser']) && isset($_POST['nPass'])) {

    $Login = new Login();
    $usuario = $_POST['nUser'];
    $senha = $_POST['nPass'];

    $Login->setUsuario($usuario);
    $Login->setSenha($senha);
    // $Login->setSenha(md5($_POST['pass']));

    if ($Login->login($usuario, $senha)) {
        $codigoUsuario = $Login->getCodigoUsuario();
        print $codigoUsuario;
    } else {
        print 0;
    }
} else {
    echo "Por favor, forneça o usuário e a senha.";
}